<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function data(Request $request)
    {
       $data = DB::table('orders')->get();
       return $data;
    // $report = array();    
    // $date1 = $request->json()->get('date1');
    // $date2 = $request->json()->get('date2');

    // $data = DB::table('orders')->whereBetween('created_at',[$date1, $date2])->get();
    // foreach ($data as $d) {
    //     array_push($report, array(
    //         'created_at'         => date('d-m-Y | H:i', strtotime($d['created_at'])),
    //         'order_number'       => $d['order_number'],
    //         'police_number'      => $d['police_number'],
    //         'generals_id'        => $d['generals_id'],
    //         'total'              => $d['total'],
    //         'discount'           => $d['discount'],
    //         'grand_total'        => $d['grand_total']
    //     ));
    // }
    // return $report;
    }
}
