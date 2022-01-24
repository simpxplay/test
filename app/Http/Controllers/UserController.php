<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserDestroy;
use App\Http\Requests\UserUpdate;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = app()->make(UserService::class);
    }

    public function index()
    {
        $users = User::user()->paginate(10);
        return view('user.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(UserUpdate $request, User $user)
    {
        $this->userService->update($user, $request->validated(), $request->file()['file']);
        return redirect()->route('users.index');
    }

    public function destroy(UserDestroy $request, User $user)
    {
        $this->userService->delete($user);
        return redirect()->route('users.index');
    }
}
