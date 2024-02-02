<?php

namespace App\Http\Controllers\InventarioController\Services;
use App\Models\Zona;
use Illuminate\Support\Facades\DB;


class DeleteZonaService
{

    public static function delete($id){

        DB::beginTransaction();

        try {

            //eleiminar file
            $zona = Zona::findOrFail($id);

            $zona->load(['inventario']);

            if($zona->inventario != '[]'){

                return response()->json(['status' => 'ko' ,'smg' => 'Categoría esta relacionada']);
            }

            $zona->delete();

               
          DB::commit();


              return response()->json(['status' => 'ok' ,'smg' => 'Item eliminado']);

                    
        } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
        }

    }



}
