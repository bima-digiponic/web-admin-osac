<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class JasaController extends Controller
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
        $kt = $request->input('kategori');
        $jk = $request->input('jenis_kendaraan');

        $path_ = DB::table('cms_settings')->where('name','lokasi_penyimpanan')->get();
        $path = $path_[0]->content;

        if(!empty($kt) && !empty($jk)){
            $data = DB::table('services as srv')
                        ->join('tb_general as kt','srv.kategori','=','kt.id')
                        ->join('tb_general as jk','srv.jenis_kendaraan','=','jk.id')
                        ->select('srv.*','kt.keterangan as kategori_keterangan','jk.keterangan as jenis_kendaraan_keterangan')
                        ->where('srv.kategori', $kt)
                        ->where('srv.jenis_kendaraan', $jk)
                        ->whereNull('srv.deleted_at')
                        ->get();                     
        }else{
            $data = DB::table('services as srv')
                        ->join('tb_general as kt','srv.kategori','=','kt.id')
                        ->join('tb_general as jk','srv.jenis_kendaraan','=','jk.id')
                        ->select('srv.*','kt.keterangan as kategori_keterangan','jk.keterangan as jenis_kendaraan_keterangan')
                        ->whereNull('srv.deleted_at')
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
}
