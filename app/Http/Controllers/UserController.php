<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = app()->make(UserService::class);
    }

    public function index()
    {
        $users = User::whereHas('role', function ($q) {
            $q->where('title', Role::USER);
        })->paginate(10);
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $this->userService->store($request->validated());
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $this->userService->update($user, $request->validated());
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $this->userService->delete($user);
        return redirect()->route('users.index');
    }
}
