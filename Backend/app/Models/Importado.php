<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Importado extends Model
{
    use HasFactory, Uuids;

    protected $table = 'importados';

    protected $fillable = [
        'name',
        'peso',
        'type',

    ];

}
