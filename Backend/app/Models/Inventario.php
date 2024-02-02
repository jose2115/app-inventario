<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Inventario extends Model
{
    use HasFactory, Uuids;

    protected $table = 'inventarios';

    protected $fillable = [
        'name',
        'select',

    ];

}
