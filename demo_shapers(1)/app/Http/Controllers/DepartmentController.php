<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\DataTables\DepartmentDataTable;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    protected $site_settings;
    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        $this->middleware('auth');
    }

   
    public function index(DepartmentDataTable $dataTable)
    {
        $title = 'Department List';
        return $dataTable->render('admin.department_list', compact('title'));
    }

   
    public function create()
    {
        $menus_permission = Menu::where('status', '1')->get();
        $title = 'Add Department';
        return view('form.add_department', compact('menus_permission', 'title'));
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            "name" => "required|unique:departments,name",
        ],
        [
            'name:unique' => 'This department already exists..'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' =>false, 'msg' => $validator->errors()->first()]);
            die;
        }
        DB::beginTransaction();
        try {
            $department = new Department;
            $department->name = $request->name;
            $department->add_menu = ($request->add) ? implode(',', $request->add) : null;
            $department->edit_menu = ($request->edit) ? implode(',', $request->edit) : null;
            $department->view_menu = ($request->view) ? implode(',', $request->view) : null;
            $department->delete_menu = ($request->delete) ? implode(',', $request->delete) : null;
            $department->download_menu = ($request->download) ? implode(',', $request->download) : null;
            $department->submit_btn_menu = ($request->submit_btn) ? implode(',', $request->submit_btn) : null;
            $department->created_by = auth()->user()->name . ' | ' . now();
            if ($department->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'New department added.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    
    public function show($id)
    {
        if(!$id){
            return abort(404);
            die;
        }

        $menus_permission = Menu::where('status', '1')->get();
        $department = Department::where('id', $id)->first();
        $title = "Edit Department";
        return view('form.edit_department', compact('menus_permission', 'title', 'department'));
    }

 
    

    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),["name" => "required|unique:departments,name,$request->id,id"]);
        if ($validator->fails()) {
            return response()->json(['status' =>false, 'msg' => $validator->errors()->first()]);
            die;
        }
        DB::beginTransaction();
        try {
            $department = Department::find($request->id);
            $department->name = $request->name;
            $department->add_menu = ($request->add) ? implode(',', $request->add) : null;
            $department->edit_menu = ($request->edit) ? implode(',', $request->edit) : null;
            $department->view_menu = ($request->view) ? implode(',', $request->view) : null;
            $department->delete_menu = ($request->delete) ? implode(',', $request->delete) : null;
            $department->download_menu = ($request->download) ? implode(',', $request->download) : null;
            $department->submit_btn_menu = ($request->submit_btn) ? implode(',', $request->submit_btn) : null;
            $department->updated_at = now();
            if ($department->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Department updated.']);
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
            $menu = Department::find($request->id);
            if ($menu->delete()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Department deleted successfully']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Record not deleted!']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }
}
