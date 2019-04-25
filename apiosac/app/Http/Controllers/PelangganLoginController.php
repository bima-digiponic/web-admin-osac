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
    
    public function login(Request $request)
    {
      $username = $request->input('username');
      $password = $request->input('password');

      if(empty($username) && empty($password)){
          $data = '';
      }else{
        $data = DB::table('tb_customer_')
        ->select('name','email','phone','address','nomor_polisi','nomor_rangka','nomor_mesin')
        ->where('email',$username)
        ->orWhere('phone', $username)
        ->where('password',$password)
        ->get();
      }
      return $data;
    }
    public function register(Request $request)
    {
        $param = $request->json()->all();
        $cek = DB::table('tb_customer_')
                    ->where('email', $param['email'])
                    ->orWhere('phone', $param['phone'])
                    ->exists();
        if($cek){
            $data = 'Ooppss data telah terdaftar';
        }else{
            $new = DB::table('tb_customer_')->insertGetId($param);
            $data = DB::table('tb_customer_')->where('id', $new)->first();
            $data = json_decode(json_encode($data), true);
        }
        return $data;
    }
    public function update(Request $request, $id)
    {
        $param = $request->json()->all();
         unset($param['email'],$param['phone']);

        $new = DB::table('tb_customer_')->update($param);
        $data = DB::table('tb_customer_')->where('id',$new)->first();
        $data = json_decode(json_encode($data), true);
        $status = ($data) ? true : false;
        $msg = array(
            'status' => $status,
            'message' => ($status) ? 'Succes' : 'Failed'
        );
        return $msg;
    }

}
