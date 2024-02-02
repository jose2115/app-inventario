<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInventario extends Model
{
    use HasFactory, Uuids;

    protected $table = 'details_inventarios';

    protected $fillable = [
        'product_id',
        'zona_id',
        'inventario_id'

    ];


    public function producto()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }
}
