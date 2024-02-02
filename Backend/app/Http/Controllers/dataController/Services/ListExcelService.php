<?php

namespace App\Http\Controllers\dataController\Services;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ListExcelService
{

    

    public static function list(){

        DB::beginTransaction();

            try {

                $file = File::with('importados')->get();

                $file = $file->map(function ($fi) {
                    $fi->name  = $fi->name;
                    $fi->type  = $fi->type;
                    
                    $numeroRecortado = number_format($fi->importados->peso, 2, '.', '');
          
                    $fi->size  = $numeroRecortado;
                    
                    $fi->date    = Carbon::parse($fi->created_at)->format('Y-m-d');
                    
        
                    return [
                        'id'        => $fi->id,
                        'name'      => $fi->name,
                        'type'      => $fi->type,
                        'size'      => $fi->size,
                        'date'      => $fi->date,
                    ];
                });


                return $file;

    

                  $status  = 'ok';
                  $message = 'delete';

        DB::commit();

              return response()->json(['status' => $status , 'smg'   => $message]);
        
            } catch (\Exception $ex) {

                return response()->json(['warning' => $ex->getMessage()]);
            }

    }


}
