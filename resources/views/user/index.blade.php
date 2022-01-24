<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2>Users</h2><br>

                @if($users->count() > 0)
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->role->title === \App\Models\Role::ADMIN)
                                <th>Edit</th>
                                <th>Delete</th>
                            @endif
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                @if(\Illuminate\Support\Facades\Auth::user()->role->title === \App\Models\Role::ADMIN)
                                    <td><a href="{{ route('users.edit', [$user->id]) }}">Edit</a></td>
                                    <td>
                                        <form action="{{ route('users.destroy', [$user->id]) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <input type="submit" value="Delete">
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        {{ $users->links() }}
                    </table>
                @else
                    No users yet
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
