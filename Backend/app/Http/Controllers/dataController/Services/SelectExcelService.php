<?php

namespace App\Http\Controllers\dataController\Services;

use App\Models\File;
use App\Models\Product;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SelectExcelService
{

    

    public static function select($id){

        DB::beginTransaction();

            try {

                $file = File::find($id);

                // Ruta al archivo Excel en la carpeta files
                $filePath = public_path("files/{$file->name}");

                // Verifica si el archivo existe
                if (!file_exists($filePath)) {
                    return response()->json(['error' => 'El archivo no existe.']);
                }

                // Importar los datos del archivo Excel a una colección
                $data = Excel::toCollection(null, $filePath);
         
                //return json_decode($data[0][1][3]);
                //return self::kindOfFood($data[0][1][2]);
                $indexOuter = 0;
                // Procesar los datos e insertarlos en la tabla Ingredient
                if ($data && $data->count()) {

                    foreach ($data as $row) {
                        $indexOuter++; // Incrementa el índice externo
                        foreach ($row as $index => $element) {

                            if($index != 0){
                                self::products($element);
                            }
                            // Realiza operaciones con $element
                            
        
                        }
                    }

                }

                  $status  = 'ok';
                  $message = 'productos';

        DB::commit();

              return response()->json(['status' => $status , 'smg'   => $message]);
        
            } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }


    public static function products($data)
    {

        $products = Product::updateOrCreate(
            [
                'talla'         => $data[4],
                'description'   => $data[6],
                'color'         => $data[5]
            ],
            [
                'ref'           => $data[0],
                'cod-barra-1'   => $data[1],
                'cod-barra-2'   => $data[2],
                'cod-barra-3'   => $data[3],
                'talla'         => $data[4],
                'description'   => $data[6],
                'color'         => $data[5],
                'unidad'        => $data[7],
            ]
        );

    }


}
