<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class TipeController extends Controller
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
        $param = $request->all();
        
        $path_ = DB::table('cms_settings')->where('name','lokasi_penyimpanan')->get();
        $path = $path_[0]->content;

        $data = DB::table('tb_tipe')->whereNull('deleted_at')->get();

        if(!empty($param)){
            $data = DB::table('tb_general')
                        ->where('kode_tipe',$param['id_tipe'])
                        ->whereNull('deleted_at')
                        ->get();
        }

        $count = count($data);
        for ($i=0; $i < $count; $i++) { 
            if($data[$i]->gambar == null)
                $data[$i]->gambar = null;
            else
                $data[$i]->gambar = $path."/".$data[$i]->gambar;
        }         

        return $data;
    }    

    public function detil($keterangan)
    {
        $path_ = DB::table('cms_settings')->where('name','lokasi_penyimpanan')->get();
        $path = $path_[0]->content;

        $tipe = DB::table('tb_tipe')
                    ->where('keterangan', $keterangan)
                    ->whereNull('deleted_at')
                    ->first();

        $data = DB::table('tb_general')
                ->where('kode_tipe', $tipe->id)
                ->whereNull('deleted_at')
                ->get();
        
        $count = count($data);
        for ($i=0; $i < $count; $i++) { 
            if($data[$i]->gambar == null)
                $data[$i]->gambar = null;
            else
                $data[$i]->gambar = $path."/".$data[$i]->gambar;
        }  
        
        return $data;
    }
}
