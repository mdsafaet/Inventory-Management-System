<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles/Create
            </h2>
            <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Form to Edit a Role -->
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="text-lg font-medium">Name:</label>
                            <div class="my-3">
                                <input value="{{ old('name') }}" type="text" name="name" id="name" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Name">
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="text-lg font-medium">Email:</label>
                            <div class="my-3">
                                <input value="{{ old('email') }}" type="text" name="email" id="email" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter email">
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="text-lg font-medium">Password:</label>
                            <div class="my-3">
                                <input value="{{ old('password') }}" type="password" name="password" id="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter password">
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="text-lg font-medium">Confirm Password:</label>
                            <div class="my-3">
                                <input value="{{ old('confirm_password') }}" type="confirm_password" name="confirm_password" id="confirm_password" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder=" confirm password">
                            </div>
                            @error('confirm_password')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-4 mb-3">
                            @if ($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                    <div class="mt-3">

                                        <input type="checkbox" name="role[]" id="role-{{ $role->id }}" value="{{ $role->name }}" >

                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="">
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Create</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
