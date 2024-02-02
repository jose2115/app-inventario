<?php

namespace App\Http\Controllers\InventarioController\Services;

use App\Models\DetailInventario;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;

class CreateDetailsInventarioService
{

    public static function details($request){

        DB::beginTransaction();

          try {

            foreach ($request->items as $key => $value) {
                
                self::CreateDetails($value);
            }
            
               
        DB::commit();


            return response()->json(['status' => 'ok' , 'smg' => 'Contando...']);

            } catch (\Exception $ex) {
            
        DB::rollBack();

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }


    public static function CreateDetails($value)
    {

        for ($i=0; $i < $value['unidad'] ; $i++) { 
            
            $details = new DetailInventario();

            $details->product_id = $value['product_id'];
            $details->zona_id    = $value['zona_id'];
            $details->inventario_id = self::inventarioActivo();

            $details->save();
            
        }
            
    

    }


    public static function inventarioActivo()
    {

        $inventario = Inventario::where('select', 1)->first();

        return $inventario->id;
    }




}
