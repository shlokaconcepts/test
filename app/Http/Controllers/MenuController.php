<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\DataTables\MenuDataTable;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        $this->middleware('auth');
    }

    public function index(MenuDataTable  $dataTable)
    {
        $title = 'Menu List';
        return $dataTable->render('admin.menu_list', compact('title'));
    }

    public function create(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_name' => 'required|string',
            'add' => 'required|numeric',
            'edit' => 'required|numeric',
            'view' => 'required|numeric',
            'delete' => 'required|numeric',
            'download' => 'required|numeric',
            'submit_btn' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>false,'input_error'=>$validator->errors()]);
            die;
        }
        DB::beginTransaction();
        try {
            $menu = new Menu();
            $menu->menu_name = $request->menu_name;
            $menu->add = $request->add;
            $menu->edit = $request->edit;
            $menu->view = $request->view;
            $menu->delete = $request->delete;
            $menu->download = $request->download;
            $menu->submit_btn = $request->submit_btn;
            if ($menu->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'New menu created successfully']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Record not created!']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    
   
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_name' => 'required|string',
            'add' => 'required|numeric',
            'edit' => 'required|numeric',
            'view' => 'required|numeric',
            'delete' => 'required|numeric',
            'download' => 'required|numeric',
            'submit_btn' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>false,'input_error'=>$validator->errors()]);
            die;
        }
        DB::beginTransaction();
        try {
            $menu = Menu::find($request->id);
            $menu->menu_name = $request->menu_name;
            $menu->add = $request->add;
            $menu->edit = $request->edit;
            $menu->view = $request->view;
            $menu->delete = $request->delete;
            $menu->download = $request->download;
            $menu->submit_btn = $request->submit_btn;
            if ($menu->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Menu updated successfully']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Record not updated!']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request,$id=null)
    {

        DB::beginTransaction();
        try {
            $menu = Menu::find($request->id);
            if ($menu->delete()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Menu deleted successfully']);
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
