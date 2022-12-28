<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class SettingController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
    }
    public function index()
    {


        if (in_array(14, auth()->user()->get_allowed_menus()['view'])) {
            $data = Setting::first();
            $title = 'Site Setting';
            return view('form.edit_setting', compact('title', 'data'));
        } else {
            return abort(404);
        }
    }


    public function update(Request $request, Setting $setting)
    {
        $validator = Validator::make($request->all(), [
            "site_title" => 'required',
            "meta_title" => 'required',
            "meta_keyword" => 'required',
            "meta_description" => 'required',
            "phone" => 'required',
            "email" => 'required',
            "address" => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $data = [
            "site_title" => $request->site_title,
            "meta_title" => $request->meta_title,
            "meta_keyword" => $request->meta_keyword,
            "meta_description" => $request->meta_description,
            "email" => $request->email,
            "address" => $request->address,
            "copy_right" => $request->copy_right,
            "phone" => $request->phone,
            "side_bar" => $request->side_bar,
            "theme_color" => $request->theme_color,
        ];

        $disk = Storage::disk('gcs');
        if ($request->file('site_favicon')) {
            $file = $request->file('site_favicon');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $data['favicon'] = $fnn;
        }

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $data['logo'] = $fnn;
        }


        $setting = Setting::find($request->id);

        if ($setting) {
            // if ($request->file('logo')) {
            //     $disk->delete($setting->logo);
            // }
            // if ($request->file('site_favicon')) {
            //     $disk->delete($setting->favicon);
            // }
            if ($setting->update($data)) {
                return response()->json(['status' => true, 'msg' => 'Edit Successfully!']);
            } else {
                return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
            }
        } else {
            return response()->json(['status' => false, 'msg' => ' wrong credentiol!']);
        }
    }
}
