<?php

namespace App\Http\Controllers;

use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\DataTables\ExamQuestionDataTable;
use App\DataTables\Scopes\ExamQuestionScope;
use App\Models\ExamSet;
use App\Models\Setting;

class ExamQuestionController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        $this->middleware('auth');
    }

    public function index(ExamQuestionDataTable $dataTable)
    {
        $title = 'Exam Question List';
        $exam_sets=ExamSet::all(['id','name']);
        return $dataTable->addScope(new ExamQuestionScope)->render('admin.exam_question', compact('title','exam_sets'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'english_question' => 'required|string',
            'hindi_question' => 'required|string',
            'english_option_one' => 'required|string',
            'hindi_option_one' => 'required|string',
            'english_option_two' => 'required|string',
            'hindi_option_two' => 'required|string',
            'english_option_three' => 'required|string',
            'hindi_option_three' => 'required|string',
            'english_option_four' => 'required|string',
            'hindi_option_four' => 'required|string',
            'answer' => 'required|numeric',
            'company' => 'required|numeric',
            'exam_set' => 'required|numeric',
            'category'=>'required|numeric',
            'trade'=>'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $exam = new ExamQuestion();
            $exam->english_question = $request->english_question;
            $exam->hindi_question = $request->hindi_question;
            $exam->english_option_one = $request->english_option_one;
            $exam->hindi_option_one = $request->hindi_option_one;
            $exam->english_option_two = $request->english_option_two;
            $exam->hindi_option_two = $request->hindi_option_two;
            $exam->english_option_three = $request->english_option_three;
            $exam->hindi_option_three = $request->hindi_option_three;
            $exam->english_option_four = $request->english_option_four;
            $exam->hindi_option_four = $request->hindi_option_four;
            $exam->answer = $request->answer;
            $exam->marks = 1;
            $exam->status = 1;
            $exam->company = $request->company;
            $exam->exam_set = $request->exam_set;
            $exam->category = $request->category;
            $exam->trade = $request->trade;
            $exam->created_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));
          
            if ($exam->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'New question added.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, ExamQuestion $examQuestion)
    {
        $validator = Validator::make($request->all(), [
            'english_question' => 'required|string',
            'hindi_question' => 'required|string',
            'english_option_one' => 'required|string',
            'hindi_option_one' => 'required|string',
            'english_option_two' => 'required|string',
            'hindi_option_two' => 'required|string',
            'english_option_three' => 'required|string',
            'hindi_option_three' => 'required|string',
            'english_option_four' => 'required|string',
            'hindi_option_four' => 'required|string',
            'answer' => 'required|numeric',
            'company' => 'required|numeric',
            'exam_set' => 'required|numeric',
            'category'=>'required|numeric',
            'trade'=>'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $exam = ExamQuestion::find($request->id);
            $exam->english_question = $request->english_question;
            $exam->hindi_question = $request->hindi_question;
            $exam->english_option_one = $request->english_option_one;
            $exam->hindi_option_one = $request->hindi_option_one;
            $exam->english_option_two = $request->english_option_two;
            $exam->hindi_option_two = $request->hindi_option_two;
            $exam->english_option_three = $request->english_option_three;
            $exam->hindi_option_three = $request->hindi_option_three;
            $exam->english_option_four = $request->english_option_four;
            $exam->hindi_option_four = $request->hindi_option_four;
            $exam->answer = $request->answer;
            $exam->marks = 1;
            $exam->status = 1;
            $exam->company = $request->company;
            $exam->exam_set = $request->exam_set;
            $exam->category = $request->category;
            $exam->trade = $request->trade;
            $exam->updated_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));
            if ($exam->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Question updated successfully.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to update.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            if (ExamQuestion::find($request->id)->delete()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Deleted Successfully!']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to delete!']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function update_status(Request $request)
    {
        DB::beginTransaction();
        try {
            $find = ExamQuestion::find($request->id);
            $find->status = ($find->status == 'inactive') ? 'active' : 'inactive';
            if ($find->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Successfully change!']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to create!']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }
}
