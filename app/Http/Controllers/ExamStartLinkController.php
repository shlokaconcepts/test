<?php

namespace App\Http\Controllers;

use App\Models\ExamStartLink;
use App\Models\SendMailJob;
use App\Models\User;
use App\Models\UserAssessment;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamStartLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamStartLink  $examStartLink
     * @return \Illuminate\Http\Response
     */
    public function show(ExamStartLink $examStartLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamStartLink  $examStartLink
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamStartLink $examStartLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExamStartLink  $examStartLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamStartLink $examStartLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamStartLink  $examStartLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamStartLink $examStartLink)
    {
        //
    }


    public function send_exam_link(Request $request)
    {

        if (count($request->data) > 0) {
            foreach ($request->data as $key => $value) {
                $user = User::leftJoin('exams', 'exams.id', '=', 'users.exam_id')
                    ->where('users.id', $value['id'])
                    ->select('users.id', 'users.full_name', 'users.last_name', 'users.email', 'users.company', 'users.exam_id', 'exams.date as exam_date')
                    ->first();

                if ($user) {
                    DB::beginTransaction();
                    try {
                        // if exists same exam
                        ExamStartLink::where('user_id', $user->id)->where('exam_id', $user->exam_id)->delete();
                        $token = Str::random(40);
                        $link = new ExamStartLink();
                        $link->user_id = $user->id;
                        $link->exam_id = $user->exam_id;
                        $link->company = $user->company;
                        $link->exam_date = $user->exam_date;
                        $link->access_token = $token;
                        $link->full_url = url('candidate-exam');
                        $details = [
                            'subject' => 'Exam Link',
                            'exam_url' => $link->full_url,
                            'site_name' => env('APP_NAME'),
                            'contact' => env('MAIL_FROM_ADDRESS'),
                            'name' => $user->full_name,
                        ];

                        $user->exam_link_status = '1';

                        $find_ass = UserAssessment::where('user_id', $user->id)->first();
                        if ($find_ass) {
                            $ass = $find_ass;
                        } else {
                            $ass = new UserAssessment();
                        }

                        $ass->user_id = $user->id;
                        $ass->assessment_status = 'Not Attempt';

                        SendMailJob::where('email', $user->email)->where('mail_type', 'exam_link')->delete();
                        $job = new SendMailJob();
                        $job->email = $user->email;
                        $job->mail_type = 'exam_link';
                        $job->data = json_encode($details);

                        if ($user->save() && $link->save() && $ass->save() && $job->save()) {
                            DB::commit();
                            return response()->json(['status' => true]);
                        } else {
                            DB::rollback();
                            return response()->json(['status' => false]);
                        }
                    } catch (\Throwable $e) {
                        DB::rollback();
                        return response()->json(['status' => true, 'msg' => $e]);
                    }
                }
            }
            return response()->json(['status' => true, 'msg' => 'Link Share Successfully!']);
        }
    }
}
