<?php

namespace App\Http\Controllers\InventarioController\Services;

use App\Models\DetailInventario;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;


class HistorialService
{

    public static function historial(){

        DB::beginTransaction();

          try {

            $historial = DetailInventario::where('inventario_id', self::inventarioActivo())
            ->with(['producto', 'zona'])
            ->select('product_id', \DB::raw('count(*) as total'), \DB::raw('MAX(zona_id) as zona_id'))
            ->groupBy('product_id')
            ->take(500)
            ->get();


            $historial = $historial->map(function ($historia) {
          
                          
                return [
                    'id'            => $historia->id,
                    'name'          => $historia->producto->description,
                    'total'         => $historia->total,
                    'color'         => $historia->producto->color,
                    'talla'         => $historia->producto->talla,
                    'zona'          => $historia->zona->name,
                    'ref'           => $historia->producto->ref,
                    'cod-barra-1'   => $historia->producto['cod-barra-1'],
                    'cod-barra-2'   => $historia->producto['cod-barra-2'],
                    'cod-barra-3'   => $historia->producto['cod-barra-3'],
                ];
            });


            
               
        DB::commit();

            return response()->json(['status' => 'ok'  , 'smg'   => 'Historial', 'data' => $historial]);

            } catch (\Exception $ex) {
            
        DB::rollBack();

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }

    public static function inventarioActivo()
    {

        $inventario = Inventario::where('select', 1)->first();

        return $inventario->id;
    }






}
