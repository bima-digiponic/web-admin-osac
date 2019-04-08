<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class CabangController extends Controller
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
       $cabang = $request->input('cabang');
       if(empty($vehicle)){
           $data = DB::table('tb_cabang as cb')
                    ->join('tb_provinsi as pv', 'tb_cabang.keterangan', '=', 'pv.id')
                    ->join('tb_kecamatan as kc', 'tb_cabang.keterangan', '=', 'kc.id')
                    ->join('tb_kota as kt', 'tb_cabang.keterangan', '=', 'kt.id')
                    ->select('cb*. cb.keterangan as keterangan')
                    ->get();
       }else{
                    
       }
       $count = count($data);
       for ($i=0; $i < $count; $i++) { 
           $data[$i]->images = 'http://app.digiponic.co.id/osac/public/'.$data[$i]->images;
       }

       return $data;
    }
}
