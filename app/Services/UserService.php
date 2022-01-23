<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

final class UserService extends BaseService
{
    public function store(array $data): User
    {
        try {
            DB::beginTransaction();

            $user = new User($data);
            //TODO: If we want to create user with another role update associate parameter to $data->role_id and add it in dto
            $user->role()->associate(Role::where('title', Role::USER)->first());
            $user->save();

            DB::commit();

            return $user;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }

    public function update(User $user, array $data): User
    {
        try {
            DB::beginTransaction();

            $user->fill($data);
            //TODO: uncomment if want to update role
            //$user->role()->associate($data['role_id'] ?? $user->role);
            $user->save();

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
