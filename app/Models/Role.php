<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    const VIEWER_ROLE_ID = 1;
    const WRITER_ROLE_ID = 2;
    const ADMIN_ROLE_ID = 3;

}
