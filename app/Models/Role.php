<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use Uuid;

    const USER = 'user';
    const ADMIN = 'admin';

    protected array $fillable = ['title'];
}
