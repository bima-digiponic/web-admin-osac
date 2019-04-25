<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class PelangganLoginController extends Controller
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
    
    // public function login(Request $request)
    // {
    //   $username = $request->input('username');
    //   $password = $request->input('password');

    //   if(empty($username) && empty($password)){
    //       $data = '';
    //   }else{
    //     $data = DB::table('tb_customer_')
    //     ->select('name','email','phone','address','nomor_polisi','nomor_rangka','nomor_mesin')
    //     ->where('email',$username)
    //     ->orWhere('phone', $username)
    //     ->where('password',$password)
    //     ->get();
    //   }
    //   return $data;
    // }
    // public function register(Request $request)
    // {
    //     $param = $request->json()->all();
    //     $cek = DB::table('tb_customer_')
    //                 ->where('email', $param['email'])
    //                 ->orWhere('phone', $param['phone'])
    //                 ->exists();
    //     if($cek){
    //         $data = 'Ooppss data telah terdaftar';
    //     }else{
    //         $new = DB::table('tb_customer_')->insertGetId($param);
    //         $data = DB::table('tb_customer_')->where('id', $new)->first();
    //         $data = json_decode(json_encode($data), true);
    //     }
    //     return $data;
    // }
    // public function update(Request $request, $id)
    // {
    //     $param = $request->json()->all();
    //      unset($param['email'],$param['phone']);

    //     $new = DB::table('tb_customer_')->update($param);
    //     $data = DB::table('tb_customer_')->where('id',$new)->first();
    //     $data = json_decode(json_encode($data), true);
    //     $status = ($data) ? true : false;
    //     $msg = array(
    //         'status' => $status,
    //         'message' => ($status) ? 'Succes' : 'Failed'
    //     );
    //     return $msg;
    // }

    public function login(request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        
        if(empty($username) && empty($password)){
            $data = '';
        }else{
            $data = DB::table('tb_customer as cs')
            ->join('tb_provinsi as pv', 'cs.kode_provinsi', '=', 'pv.id')
            ->join('tb_kecamatan as kc', 'cs.kode_kecamatan', '=', 'kc.id')
            ->join('tb_kota as kt', 'cs.kode_kota', '=', 'kt.id')
            ->join('tb_kendaraan_pelanggan as pg', 'pg.id')
            ->select('cs.*','pv.keterangan as kode_provinsi', 'kc.keterangan as kode_kecamatan', 'kt.keterangan as kode_kota')
            ->where('cs.email',$username)
            ->orWhere('cs.nohp', $username)
            ->where('cs.password',$password)
            ->get();
        }

        // $param = $request->json()->all();
        // // $username = $request->input('username');
        // // $password = $request->input('password');
        // $cek = DB::table('tb_customer')
        //             ->where('email', $param['email'])
        //             ->orWhere('nohp', $param['nohp'])
        //             ->exists();
        // if($cek){
        //     $data = DB::table('tb_customer')->get();
        //     $data = json_decode(json_encode($data), true);
        // }else{
        //     $data = 'Anda belum terdaftar';
        // }
         return $data;        
    }
    
    public function register(Request $request)
    {
        $param = $request->json()->all();
        $paramkendaraan = $request->json(); 
        $cek = DB::table('tb_customer')
                    ->where('email', $param['email'])
                    ->orWhere('nohp', $param['nohp'])
                    ->exists();
        if($cek){
            $data = 'Ooppss data telah terdaftar';
        }else{
            $new = DB::table('tb_customer')->insertGetId($param);
            $data = DB::table('tb_customer')->where('id', $new)->first();
            //bikin variable lagi $kendaaraanpelanggan id customer, nomor polisi(ambio dari parah);
            $data = json_decode(json_encode($data), true);
        }
        return $data;
    }

    public function update(Request $request)
    {
        $param = $request->json()->all();
         unset($param['email'],$param['nohp']);

        $new = DB::table('tb_customer')->update($param);
        $data = DB::table('tb_customer')->where('id',$new)->first();
        $data = json_decode(json_encode($data), true);
        $status = ($data) ? true : false;
        $msg = array(
            'status' => $status,
            'message' => ($status) ? 'Succes' : 'Failed'
        );
        return $msg;
    }
}
