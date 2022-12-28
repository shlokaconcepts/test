<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\View;

class LandingPageController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings=Setting::first();
        View::share('setting', $this->site_settings);
    }

    public function index()
    {
        // return abort('404', 'The post you are looking for was not found');
        return view('index');
    }

    public function privacy_policy()
    {
        $title="Privacy Policy";
       return view('pages.privacy',compact('title'));
    }

    public function terms_condition()
    {
        $title="Terms & Conditions";
        return view('pages.term',compact('title'));
    }
}
