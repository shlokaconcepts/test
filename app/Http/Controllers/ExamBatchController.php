<?php

namespace App\Http\Controllers;

use App\Models\ExamBatch;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\DataTables\ExamBatchDataTable;
use App\DataTables\Scopes\ExamBatchScope;
use App\Models\Setting;

class ExamBatchController extends Controller
{
    protected $site_settings;
    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        $this->middleware('auth');
    }

    public function index(ExamBatchDataTable $dataTable)
    {
        $title = 'Exam Batch List';
        return $dataTable->addScope(new ExamBatchScope)->render('admin.exam_batch_list', compact('title'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'password' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'company' => 'required|numeric',
            'exam' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }
        DB::beginTransaction();
        try {
            $exam = new ExamBatch();
            $exam->name = $request->title;
            $exam->password = $request->password;
            $exam->start_time = date('g:i A',strtotime($request->start_time));
            $exam->end_time = $request->end_time;
            $exam->company = $request->company;
            $exam->exam = $request->exam;
            $exam->created_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));
            if ($exam->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'New batch added.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, ExamBatch $examBatch)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'password' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'company' => 'required|numeric',
            'exam' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }
        DB::beginTransaction();
        try {
            $exam =  ExamBatch::find($request->id);
            $exam->name = $request->title;
            $exam->password = $request->password;
            $exam->start_time = date('g:i A',strtotime($request->start_time));
            $exam->end_time = $request->end_time;
            $exam->company = $request->company;
            $exam->exam = $request->exam;
            $exam->created_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));
            if ($exam->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Batch updated successfully.']);
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
            if (ExamBatch::find($request->id)->delete()) {
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

    public function get_exam_duration(Request $request)
    {
        if ($find = Exam::find($request->exam_id)) {
            $start_time = date('H:i', strtotime($request->start_time));
            $exam_duration = explode(':', $find->duration);
            $add_hour = date('H:i', strtotime('+' . $exam_duration[0] . ' hour', strtotime($start_time)));
            // h:i
            $end_time = date('g:i A', strtotime('+' . $exam_duration[1] . ' minutes', strtotime($add_hour)));
            return response()->json(['status' => true, 'duration' => $end_time]);
        } else {
            return response()->json(['status' => false, 'duration' => 'Select Exam!']);
        }
    }
}
