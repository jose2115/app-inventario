<?php

namespace App\Http\Controllers\productsController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\productsController\Services\ListProductsService;
use App\Http\Controllers\productsController\Services\ShowProductService;


class ProductsController extends Controller
{

    public function List()
    {
        return ListProductsService::list();
    }

    public function show($id)
    {
        return ShowProductService::show($id);
    }



}
