<?php

declare(strict_types=1);

namespace App\Models\Relations;

use App\Models\Role;

trait UserRelations
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
