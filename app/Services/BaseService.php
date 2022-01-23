<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class BaseService {

    public function handleException(Exception $exception)
    {
        DB::rollBack();

        Log::error($exception->getMessage());
        Log::error($exception->getTraceAsString());

        throw new Exception($exception->getMessage(), $exception->getCode(), $exception);
    }
}
