<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;

trait UserScopes
{
    public function scopeAdmin(Builder $query): Builder
    {
        return $query->whereHas('role', function (Builder $q) {
            $q->where('title', Role::ADMIN);
        });
    }

    public function scopeUser(Builder $query): Builder
    {
        return $query->whereHas('role', function (Builder $q) {
            $q->where('title', Role::USER);
        });
    }
}
