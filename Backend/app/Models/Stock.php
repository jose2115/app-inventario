<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Stock extends Model
{
    use HasFactory, Uuids;

    protected $table = 'stocks';

    protected $fillable = [

        'name',
        'stock',
        'products_id'


    ];

}
