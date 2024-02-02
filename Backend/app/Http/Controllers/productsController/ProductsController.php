<?php

namespace App\Http\Controllers\productsController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\productsController\Services\ListProductsService;
use Illuminate\Http\Request;


class ProductsController extends Controller
{

    public function List()
    {
        return ListProductsService::list();
    }



}
