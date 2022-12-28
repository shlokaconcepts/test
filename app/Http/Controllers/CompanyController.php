<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Setting;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use App\DataTables\CompanyDataTable;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    protected $site_settings;
    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        // $this->middleware('auth');
    }

    public function index(CompanyDataTable $dataTable)
    {
        $categories = CompanyCategory::all();
        $title = 'Company List';
        return $dataTable->render('admin.company_list', compact('title', 'categories'));
    }


    public function create()
    {
        $categories = CompanyCategory::all();
        $title = 'Add List';
        return view('form.add_company',compact('title','categories'));
    }


    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'prefix'   => 'required|unique:companies,prefix',
            'category' => 'required|numeric',
            'logo' => 'required|image|mimes:jpeg,jpg,png',
            'description' => 'required',
            'question_type'=>'required|numeric',
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $disk = Storage::disk('gcs');
            $company = new Company();
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $fnn = rand() . '.' . $file->getClientOriginalExtension();
                $disk->put($fnn, File::get($file));
                $disk->setVisibility($fnn, 'public');
                $company->logo = $fnn;
            }
            $company->name = $request->name;
            $company->prefix = $request->prefix;
            $company->category = $request->category;
            $company->description = $request->description;
            $company->question_type = $request->question_type;
            if ($company->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'New Company added.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'prefix'   => "required|unique:companies,prefix,$request->id,id",
            'category' => 'required|numeric',
            'logo' => 'image|mimes:jpeg,jpg,png',
            'description' => 'required',
            'question_type'=>'required|numeric',
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $disk = Storage::disk('gcs');
            $company =  Company::find($request->id);
            $old_image = $company->logo;
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $fnn = rand() . '.' . $file->getClientOriginalExtension();
                $disk->put($fnn, File::get($file));
                $disk->setVisibility($fnn, 'public');
                $company->logo = $fnn;
                Storage::disk('gcs')->delete($old_image);
            }
            $company->name = $request->name;
            $company->prefix = $request->prefix;
            $company->category = $request->category;
            $company->description = $request->description;
            $company->question_type = $request->question_type;
            if ($company->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Company updated.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $company = Company::find($request->id);
            $logo = $company->logo;
            if ($company->delete()) {
                Storage::disk('gcs')->delete($logo);
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Company deleted successfully']);
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
