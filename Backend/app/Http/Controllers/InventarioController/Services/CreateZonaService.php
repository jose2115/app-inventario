<?php

namespace App\Http\Controllers\InventarioController\Services;
use App\Models\Zona;
use Illuminate\Support\Facades\DB;

class CreateZonaService
{

    public static function store($request){

        DB::beginTransaction();

          try {

            $zona = new Zona();
            $zona->name = $request->name;

            $zona->save();
               
        DB::commit();


            return response()->json(['status' => 'ok' ,'data' => $zona, 'smg' => 'Creado Zona']);

            } catch (\Exception $ex) {
            
        DB::rollBack();

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }




}
