<?php

namespace App\Models;

use App\Traits\Uuids;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use Uuids;
}
