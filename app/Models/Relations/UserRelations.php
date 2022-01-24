<?php

declare(strict_types=1);

namespace App\Models\Relations;

use App\Models\File;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait UserRelations
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
