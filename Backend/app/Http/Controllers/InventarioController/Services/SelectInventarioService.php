<?php

namespace App\Http\Controllers\InventarioController\Services;

use App\Constants\Constant;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;

class SelectInventarioService
{

    public static function select($id){

        $inventario = Inventario::findOrFail($id);

        DB::beginTransaction();

        try {

            if($inventario->select == 1){
                $select = 0;
            }else{
                $select = 1;
            }

            $inventario->select = $select;

            $inventario->save();

            self::deSelect($inventario->id);

          DB::commit();

              return response()->json(['status' => 'ok' ,'data' => $inventario, 'smg' => "Seleccionado"]);

                    
        } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
        }

    }


    public static function deSelect($id){


        Inventario::where('id', '<>', $id)->update(['select' => 0]);


    }

   
}
