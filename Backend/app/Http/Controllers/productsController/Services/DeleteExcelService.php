<?php

namespace App\Http\Controllers\dataController\Services;

use App\Models\File;
use App\Models\Importado;
use App\Models\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;

class DeleteExcelService
{

    

    public static function delete($id){

        DB::beginTransaction();

            try {

                $file = File::find($id);

                // Ruta al archivo Excel en la carpeta files
                $filePath = public_path("files/{$file->name}");

                // Verifica si el archivo existe
                if (!file_exists($filePath)) {
                    return response()->json(['error' => 'El archivo no existe.']);
                }

                $path = public_path() . '/files/'.$file->name;

                //eleiminando el archivo excel
                FacadesFile::delete($path);

                //eliminar files
                File::destroy($id);

                //eliminar importados
                Importado::destroy($file->fileable_id);

    

                  $status  = 'ok';
                  $message = 'delete';

        DB::commit();

              return response()->json(['status' => $status , 'smg'   => $message]);
        
            } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }


}
