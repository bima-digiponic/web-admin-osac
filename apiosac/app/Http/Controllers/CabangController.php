<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Illuminate\Support\Facades\Hash;

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
    
    public function getData(Request $request)
    {
       $email = $request->input('email');
       $pin = $request->input('pin');
       if(empty($email)){
           $data = DB::table('tb_cabang as cb')
                    ->join('tb_provinsi as pv', 'cb.kode_provinsi', '=', 'pv.id')
                    ->join('tb_kecamatan as kc', 'cb.kode_kecamatan', '=', 'kc.id')
                    ->join('tb_kota as kt', 'cb.kode_kota', '=', 'kt.id')
                    ->select('cb.*', 'pv.keterangan as kode_provinsi', 'kc.keterangan as kode_kecamatan', 'kt.keterangan as kode_kota')
                    ->get();
         }else{
                    $data = DB::table('tb_cabang as cb')
                    ->join('tb_provinsi as pv', 'cb.kode_provinsi', '=', 'pv.id')
                    ->join('tb_kecamatan as kc', 'cb.kode_kecamatan', '=', 'kc.id')
                    ->join('tb_kota as kt', 'cb.kode_kota', '=', 'kt.id')
                    ->select('cb.*', 'pv.keterangan as kode_provinsi', 'kc.keterangan as kode_kecamatan', 'kt.keterangan as kode_kota')
                    ->where('cb.email', $email)
                    ->where('cb.pin', $pin)
                    ->get(); 
       }
       $count = count($data);
       for ($i=0; $i < $count; $i++) { 
           $data[$i]->logo = 'http://app.digiponic.co.id/osac/public/'.$data[$i]->logo;
       }
       return $data;
    }
    public function getDataMasuk(Request $request)
    {
        $email = $request->input('email');
        $pin = $request->input('pin');
        $data = DB::table('tb_cabang as cb')
        ->join('tb_provinsi as pv', 'cb.kode_provinsi', '=', 'pv.id')
        ->join('tb_kecamatan as kc', 'cb.kode_kecamatan', '=', 'kc.id')
        ->join('tb_kota as kt', 'cb.kode_kota', '=', 'kt.id')
        ->select('cb.*', 'pv.keterangan as kode_provinsi', 'kc.keterangan as kode_kecamatan', 'kt.keterangan as kode_kota')
        ->where('cb.email', $email)
        ->where('cb.pin', $pin)
        ->get(); 
       
       $count = count($data);
       for ($i=0; $i < $count; $i++) { 
           $data[$i]->logo = 'http://app.digiponic.co.id/osac/public/'.$data[$i]->logo;
       }
       return $data;
    }
    public function postData(Request $request)
    {
        $data = DB::table('tb_cabang')->insertGetId(array(
            'kode_cabang'   => $request->json()->get('kode_cabang'),
            'nama_cabang'   => $request->json()->get('nama_cabang'),
            'alamat'        => $request->json()->get('alamat'),
            'telfon'        => $request->json()->get('telfon'),
            'logo'          => $request->json()->get('logo'),
            'email'         => $request->json()->get('email'),
            'pin'           => $request->json()->get('pin'),
            'logo'          => $request->json()->get('logo'),
            'lang'          => $request->json()->get('lang'),
            'latt'           => $request->json()->get('latt'),
            'kode_provinsi' => $request->json()->get('kode_provinsi'),
            'kode_kota'     => $request->json()->get('kode_kota'),
            'kode_kecamatan'=> $request->json()->get('kode_kecamatan')
        ));
        $cabang = DB::table('tb_cabang')->insert($data);
        return $cabang;
    }
}
