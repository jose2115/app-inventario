<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $primaryKey = 'email';

    protected $fillable = ['email', 'token', 'created_at'];

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;
}
