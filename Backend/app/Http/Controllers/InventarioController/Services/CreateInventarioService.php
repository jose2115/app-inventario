<?php

namespace App\Http\Controllers\InventarioController\Services;
use App\Models\Inventario;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreateInventarioService
{

    public static function store($request){

        DB::beginTransaction();

          try {

            $inventario = new Inventario();
            $inventario->name = $request->name;
            $inventario->select = 0;


            $inventario->save();

            $inventario = [
                'id'          => $inventario->id,
                'name'        => $inventario->name,
                'select'      => $inventario->select,
                'date'        => Carbon::parse($inventario->created_at)->format('Y-m-d'),
            ];
               
        DB::commit();


            return response()->json(['status' => 'ok' ,'data' => $inventario, 'smg' => 'Creado Inventario']);

            } catch (\Exception $ex) {
            
        DB::rollBack();

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }




}
