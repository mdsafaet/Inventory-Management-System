<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles/Edit
            </h2>
            <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Form to Edit a Role -->
                    <form action="{{ route('users.update',$user->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="text-lg font-medium">Name:</label>
                            <div class="my-3">
                                <input value="{{ old('name', $user->name) }}" type="text" name="name" id="name" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Name">
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="text-lg font-medium">Email:</label>
                            <div class="my-3">
                                <input value="{{ old('email', $user->email) }}" type="text" name="email" id="email" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter email">
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-4 mb-3">
                            @if ($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                    <div class="mt-3">

                                        <input type="checkbox" name="role[]" id="role-{{ $role->id }}" value="{{ $role->name }}" {{ $hasRoles->contains($role->id) ? 'checked' : '' }}>

                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="">
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
