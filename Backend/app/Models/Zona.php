<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Zona extends Model
{
    use HasFactory, Uuids;

    protected $table = 'zonas';

    protected $fillable = [
        'name',
    ];


    public function inventario()
    {
        return $this->hasMany(DetailInventario::class);
    }


    
}
