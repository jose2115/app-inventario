<?php

namespace App\Http\Controllers\InventarioController\Services;
use App\Models\Zona;
use Illuminate\Support\Facades\DB;


class UpdateZonaService
{

    public static function update($request, $id){

        DB::beginTransaction();

        try {

            //eleiminar file
            $zona = Zona::findOrFail($id);

            $zona->name = $request->name;

            $zona->save();

               
          DB::commit();


              return response()->json(['status' => 'ok' ,'data' => $zona,'smg' => 'Item Actualizado']);

                    
        } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
        }

    }



}
