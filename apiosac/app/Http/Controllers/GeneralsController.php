<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class GeneralsController extends Controller
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
        $vehicle = $request->input('types');
        if(empty($vehicle)){
            $data = DB::table('generals')
            ->join('types as tp','generals.types_id','=','tp.id')
            ->select('generals.id','tp.name as types','generals.name', 'generals.desc')
            ->get();
        }else{
            $data = DB::table('generals')
            ->join('types', 'generals.types_id', '=', 'types.id')
            ->select('generals.id', 'types.name as type', 'generals.name', 'generals.desc')
            ->where('types.name',$vehicle)
            ->get();
        }
        return $data;
    }
}
