<?php

namespace App\Http\Controllers\dataController\Services;

use App\Models\Ciclo;
use App\Models\File;
use App\Models\Importado;
use App\Models\Product;
use App\Models\Propuesta;
use App\Models\Recipe;
use App\Models\Stock;
use App\Models\Zona;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DataProductsService
{

    public static function data($request){

        
        //self::deleteStock();
        
        DB::beginTransaction();

            try {

                $validator = Validator::make($request->all(), [
                    'file' => 'required|mimes:xls,xlsx',
                ], [
                    'file.required'     => 'Se requiere el archivo',
                    'file.mimes'        => 'El archivo debe ser .xls,xlsx',
        
                ]);
            
                if ($validator->fails()) {
                    return response()->json(['status' => 'ko' ,'data' => $validator->errors(), 'smg' => 'Error de validacion']);
                }

                // Obtener el archivo subido
                $file = $request->file('file');

                // Importar los datos del archivo Excel a una colección
                $data = Excel::toCollection(null, $file);

                //return $data;

                $importado = self::createImportado($request);

                self::upload($request, $importado );

                
         
              
                $indexOuter = 0;
                // Procesar los datos e insertarlos en la tabla Ingredient
                if ($data && $data->count()) {

                    foreach ($data as $row) {
                        $indexOuter++; // Incrementa el índice externo

                        $tamano_lote = 1000;
                        $header = $row[0];
                        
                        collect($row)->chunk($tamano_lote)->each(function ($lote) use ($header) {
                        foreach ($lote as $index => $element) {
                            if ($index != 0) {
                                $product = self::products($element);
                                self::deleteStock($product);
                                self::stock($element, $product, $header);
                                // Comprueba si existe el índice 0 en $lote antes de acceder
                    
                                // Realiza otras operaciones con $element
                            }
                        }
                    });
                    }

                }

                $data = [
                    'name'      => $importado->name,
                    'type'      => $importado->type,
                    'size'      => number_format($importado->peso, 2, '.', '') ,
                    'date'      => Carbon::parse($importado->created_at)->format('Y-m-d'),
                ];


                  $status  = 'ok';
                  $message = 'productos';

        DB::commit();

              return response()->json(['status' => $status , 'smg'   => $message, 'data' => $data]);
        
            } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }


    public static function products($data)
    {

        $products = Product::updateOrCreate(
            [
                'cod-barra-1'   => $data[4],
                'description'   => $data[1],
            ],
            [
                'ref'           => $data[5],
                'cod-barra-1'   => $data[4],
                'cod-barra-2'   => $data[2],
                'cod-barra-3'   => $data[3],
                'talla'         => $data[0],
                'description'   => $data[1],
                'talla'         => $data[6],
                'color'         => $data[7]
            ]
        );

        return $products;

    }


    public static function stock($data, $product, $row)
    {

        
        $i = 8;

        while (isset($data[$i]) && $data[$i] !== null) {

            
            $stock = new Stock;

            $stock->name = $row[$i];
            $stock->stock = $data[$i];
            $stock->products_id = $product->id;

            $stock->save();

            $i++;

        }
    }


    public static function zona($data)
    {
        $zona = Zona::updateOrCreate(
            [
                'name' => $data[8]
            ],
            [
                'name'  => $data[8],
            ]
        );

        return $zona;
    }

    public static function createImportado($request)
    {

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $extension = $file->guessExtension();

        // Obtener el tamaño del archivo en bytes
        $size = $file->getSize();
        $sizeInMB = $size / (1024 * 1024);


        $importado = new Importado();

        $importado->name = $name;
        $importado->type = $extension;
        $importado->peso = $sizeInMB;

        $importado->save();

        return $importado;

    }

    public static function upload($request, $archivo)
    {
        $appUrl = env('APP_URL'); 
        $path = public_path() . '/files';
        $file = $request->file('file');
        //obtener el nombre del archivo
        $extension = $file->guessExtension();

        $name = time() . $file->getClientOriginalName();

        $file->move($path, $name);


        $input['name'] = $name;
        $input['url'] = $appUrl.'/files/'.$name;
        $input['type'] = $extension;
        $input['fileable_id'] = $archivo->id;
        $input['fileable_type'] = 'App\Models\File';

        File::create($input);

        return true;
    }

    public static function deleteStock($product)
    {
        Stock::where('products_id', $product->id)->delete();

        /* $stocks = Stock::all();

        foreach ($stocks as $stock) {
            $stock->delete();
        } */
    }


}
