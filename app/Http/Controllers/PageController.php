<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;

class PageController extends Controller
{
    public function index()
    {
        $users = User::whereNotNull('google_id')
            ->where('is_blocked', false)
            ->user()
            ->paginate(10);
        return view('index', ['users' => $users]);
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
