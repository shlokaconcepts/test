<?php

namespace App\Http\Controllers;

use App\Models\RegistrationCategory;
use Illuminate\Http\Request;
use App\DataTables\RegistrationCategoryDataTable;
use App\DataTables\Scopes\RGCategoryScope;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

class RegistrationCategoryController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        $this->middleware('auth');
    }


    public function index(RegistrationCategoryDataTable  $dataTable)
    {
        $title = 'Registration category list';
        return $dataTable->addScope(new RGCategoryScope)->render('admin.rg_list', compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|string',
            'title'   => 'required|string',
            'company' => 'required|numeric',
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $rg_cat = new RegistrationCategory();
            $rg_cat->name = $request->name;
            $rg_cat->title = $request->title;
            $rg_cat->company = $request->company;
            $rg_cat->created_by = auth()->user()->name . ' | ' . date('d-m-Y - h:i A', strtotime(now()));
            if ($rg_cat->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'New RG-Cat. added']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, RegistrationCategory $trade)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|string',
            'title'   => 'required|string',
            'company' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }
        DB::beginTransaction();
        try {
            $rg_cat =  RegistrationCategory::find($request->id);
            $rg_cat->name = $request->name;
            $rg_cat->title = $request->title;
            $rg_cat->company = $request->company;
            if ($rg_cat->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Updated successfully']);
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
            $find = RegistrationCategory::find($request->id);
            if ($find->delete()) {
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
            $find = RegistrationCategory::find($request->id);
            $find->status = ($find->status == '0') ? '1' : '0';
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
