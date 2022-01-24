<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="post" action="{{ route('users.update', [$user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <label>Name</label>
                    <input name="name" value="{{ $user->name }}"><br>
                    <label>Email</label>
                    <input name="email" value="{{ $user->email }}"><br>
                    <label>File</label>
                    <input name="file" type="file"><br>
                    <label>Blocked</label>
                    <input name="is_blocked" type="checkbox" @if($user->is_blocked) checked @endif><br>
                    <input type="submit" value="Save">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
