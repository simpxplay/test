<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

final class UserService extends BaseService
{
    public function store(array $data, UploadedFile $file = null): User
    {
        try {
            DB::beginTransaction();

            $user = new User($data);
            //TODO: If we want to create user with another role update associate parameter to $data['role_id']
            $user->role()->associate(Role::where('title', Role::USER)->first());
            $user->save();

            if ($file) {
                $fileModel = app()->make(FileService::class)->upload($file);
                $user->file()->associate($fileModel);
                $user->save();
            }

            DB::commit();

            return $user;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }

    public function update(User $user, array $data, UploadedFile $file = null): User
    {
        try {
            DB::beginTransaction();

            $user->fill($data);
            //TODO: uncomment if want to update role
            //$user->role()->associate($data['role_id'] ?? $user->role);
            $user->is_blocked = (isset($data['is_blocked']) && $data['is_blocked'] === 'on') ? true : false;
            $user->save();

            if ($file) {
                if ($user->file()->exists()) {
                    $user->file()->delete();
                }
                app()->make(FileService::class)->upload($file, $user);
            }

            DB::commit();

            return $user;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }

    public function delete(User $user): bool
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();

            return true;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }
}
