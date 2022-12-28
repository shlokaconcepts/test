<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Http\Request;
use App\DataTables\TradeDataTable;
use App\DataTables\Scopes\TradeScope;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

class TradeController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        $this->middleware('auth');
    }
    

    public function index(TradeDataTable  $dataTable)
    {
     $title ='Trade List';
     return $dataTable->addScope(new TradeScope)->render('admin.trade_list', compact('title'));
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
        $validator = Validator::make($request->all(), [
            'name'   => 'required|string',
            'company' => 'required|numeric',
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $trade = new Trade();
            $trade->name = $request->name;
            $trade->company = $request->company;
            $trade->created_by= auth()->user()->name . ' | ' . date('d-m-Y - h:i A', strtotime(now()));
            if ($trade->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'New trade. added']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, Trade $trade)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|string',
            'company' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }
        DB::beginTransaction();
        try {
            $trade =  Trade::find($request->id);
            $trade->name = $request->name;
            $trade->company = $request->company;
            if ($trade->save()) {
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
            $find = Trade::find($request->id);
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
            $find = Trade::find($request->id);
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
