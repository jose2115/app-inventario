<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Product extends Model
{
    use HasFactory, Uuids;

    protected $table = 'products';

    protected $fillable = [

        'ref',
        'cod-barra-1',
        'cod-barra-2',
        'cod-barra-3',
        'description',
        'color',
        'talla',
        'zona_id',


    ];


    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'products_id');
    }
}
