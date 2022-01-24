<?php

declare(strict_types=1);

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait FileRelations
{
    public function fileable(): morphTo
    {
        return $this->morphTo();
    }
}
