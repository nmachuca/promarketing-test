<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    const VIEW_GAMES_PERMISSION_ID = 1;
    const CREATE_GAMES_PERMISSION_ID = 2;
    const EDIT_GAMES_PERMISSION_ID = 3;
    const DELETE_GAMES_PERMISSION_ID = 4;
}
