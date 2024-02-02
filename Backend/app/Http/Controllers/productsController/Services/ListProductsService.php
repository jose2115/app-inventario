<?php

namespace App\Http\Controllers\productsController\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ListProductsService
{

    

    public static function list(){

        DB::beginTransaction();

            try {

                $products = Product::with('zona')->get();


                $products = $products->map(function ($product) {
          
                     $stocks = $product->stock->map(function ($item){
                        
                        return [
                            'name'  => $item->name,
                            'stock' => $item->stock,
                        ];

                     });

                    return [
                        'id'            => $product->id,
                        'description'   => $product->description,
                        'stocks'        => $stocks,
                        'color'         => $product->color,
                        'talla'         => $product->talla,
                        //'zona'          => $product->zona->name,
                        'ref'           => $product->ref,
                        'cod-barra-1'   => $product['cod-barra-1'],
                        'cod-barra-2'   => $product['cod-barra-2'],
                        'cod-barra-3'   => $product['cod-barra-3'],
                    ];
                });

                  $status  = 'ok';
                  $message = 'productos';

        DB::commit();

              return response()->json(['status' => $status  , 'smg'   => $message, 'data' => $products]);
        
            } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }


}
