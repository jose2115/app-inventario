<?php

namespace App\Models;

use App\Traits\Uuids;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
 
class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use Uuids;
}