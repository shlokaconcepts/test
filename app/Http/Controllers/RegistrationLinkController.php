<?php

namespace App\Http\Controllers;

use App\Models\RegistrationLink;
use Illuminate\Http\Request;
use App\DataTables\RegistrationLinkDataTable;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

class RegistrationLinkController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        $this->middleware('auth');
    }

    public function index(RegistrationLinkDataTable  $dataTable)
    {
        $title = 'Registration Link';
        $companies=\App\Models\Company::all();
        $states=\App\Models\State::all();
        $categories=\App\Models\RegistrationCategory::all();
        $json_state=json_encode($states);
        return $dataTable->render('admin.registration_link_list', compact('title','companies','states','categories','json_state'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state.*' => 'required',
            'description' => 'required',
            'close_time' => 'required',
            'close_date' => 'required',
            'category' => 'required|numeric',
            'company' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' =>false, 'msg' => $validator->errors()->first()]);
            die;
        }

        // check link 

        if(RegistrationLink::where('company',$request->company)->where('form_category',$request->category)->first()){
            return response()->json(['status' =>false, 'msg' => "Link exists.."]);
            die;
        }

        DB::beginTransaction();
        try {

            $company=\App\Models\Company::find($request->company);
            $category=\App\Models\RegistrationCategory::find($request->category);
            $link = new RegistrationLink();
            $link->company = $request->company;
            $link->state = implode(",", $request->state);
            $link->closed_time = date('Y-m-d', strtotime($request->close_date)) . ' ' . $request->close_time;
            $link->description = $request->description;
            $link->form_category = $request->category;
            $link->created_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));
            $link->full_url = url('/register-with-my-email') . '/' . $company->prefix . '/' . $category->title;

            if ($link->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'New link created successfully']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to create!']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

  

    public function update(Request $request, RegistrationLink $registrationLink)
    {
        $validator = Validator::make($request->all(), [
            'state.*' => 'required',
            'description' => 'required',
            'close_time' => 'required',
            'close_date' => 'required',
            'category' => 'required|numeric',
            'company' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' =>false, 'msg' => $validator->errors()->first()]);
            die;
        }

        // check link 

        

        DB::beginTransaction();
        try {
            $company=\App\Models\Company::find($request->company);
            $category=\App\Models\RegistrationCategory::find($request->category);
            $link =  RegistrationLink::find($request->id);
            $link->company = $request->company;
            $link->state = implode(",", $request->state);
            $link->closed_time = date('Y-m-d', strtotime($request->close_date)) . ' ' . $request->close_time;
            $link->description = $request->description;
            $link->form_category = $request->category;
            $link->created_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));
            $link->full_url = url('/register-with-my-email') . '/' . $company->prefix . '/' . $category->title;
            if(RegistrationLink::where('full_url',$link->full_url)->where('id','!=',$request->id)->first()){
                return response()->json(['status' =>false, 'msg' => "Link exists.."]);
                die;
            }
            if ($link->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'link updated successfully']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to update!']);
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
            $find = RegistrationLink::find($request->id);
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
            $find = RegistrationLink::find($request->id);
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
