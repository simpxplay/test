<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::admin()->first();
        if (!$admin) {
            $admin = new User(['name' => 'admin', 'email' => 'admin@admin', 'password' => Hash::make('admin')]);
            $admin->role()->associate(Role::where('title', Role::ADMIN)->first());
            $admin->save();
        }
    }
}
