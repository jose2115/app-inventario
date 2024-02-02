<?php

namespace App\Http\Controllers\dataController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\dataController\Services\DataProductsService;
use App\Http\Controllers\dataController\Services\DeleteExcelService;
use App\Http\Controllers\dataController\Services\ListExcelService;
use App\Http\Controllers\dataController\Services\SelectExcelService;
use Illuminate\Http\Request;


class DataController extends Controller
{

    public function ListExcel()
    {
        return ListExcelService::list();
    }

    public function dataProducts(Request $request)
    {
        return DataProductsService::data($request);
    }

    public function selectExcel($id)
    {
        return SelectExcelService::select($id);
    }

    public function deleteExcel($id)
    {
        return DeleteExcelService::delete($id);
    }


}
