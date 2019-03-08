<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function getAllTransactions()
    {
        $data = DB::table('orders')->orderBy('order_number', 'desc')->get();
        return $data;
    }
    public function post(Request $request)
    {
        $order_number = DB::table('orders')->max('id') + 1;
        $order_number = 'PNJ/'.date('dmy').'/'.str_pad($order_number, 5, 0, STR_PAD_LEFT);
        $data = DB::table('orders')->insertGetId(array(
            'order_number'   => $order_number,
            'tipe'           => $request->json()->get('tipe'),
            'kendaraan'      => $request->json()->get('kendaraan'),
            'total'          => $request->json()->get('total'),
            'discount'       => $request->json()->get('discount'),
            'grand_total'    => $request->json()->get('grand_total'),
        ));
        if($data != null){
            $order_detail = $request->json()->get('order_detail');
            $count = count($order_detail);
            for ($i=0; $i < $count; $i++) { 
                $order_detail[$i]['orders_id'] = $data;
            }
            $order_detail = DB::table('orders_detail')->insert($order_detail);
        }else{
            $status = false;
        }
        $status = ($order_detail) ? true : false;
        $msg = array(
            'status'    => $status,
            'message'   => ($status) ? 'Success' : 'Failed'
        );
        return $msg;
    }
}
