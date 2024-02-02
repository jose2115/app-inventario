<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class File extends Model
{
    use HasFactory, Uuids;

    protected $table = 'files';

    protected $fillable = [
        'name',
        'url',
        'type',
        'fileable_type',
        'fileable_id',

    ];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function importados()
    {
        return $this->belongsTo(Importado::class, 'fileable_id');
    }
}
