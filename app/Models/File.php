<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Relations\FileRelations;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    use FileRelations;
    use Uuid;

    protected array $fillable = [
        'name',
        'file_path'
    ];

}
