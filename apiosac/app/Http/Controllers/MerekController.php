<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class MerekController extends Controller
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
        $param = $request->input('id_merek');

        $path_ = DB::table('cms_settings')->where('name','lokasi_penyimpanan')->get();
        $path = $path_[0]->content;

        $data = DB::table('tb_general')
                    ->where('kode_tipe',11)
                    ->get();

        $count = count($data);
        for ($i=0; $i < $count; $i++) { 
            if($data[$i]->gambar == null)
                $data[$i]->gambar = null;
            else
                $data[$i]->gambar = $path."/".$data[$i]->gambar;
        }                        
        
        if(!empty($param)){
            $data = DB::table('tb_kendaraan')
                        ->where('kode_general', $param)
                        ->get();            
        }    

        return $data;
    }
}
