<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
@can('Create Role')
<a href="{{ route('roles.create') }}" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Create</a>

@endcan


        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-message />

            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">#</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Permissions</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Created</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($roles->isNotEmpty())
                        @foreach ($roles as $role)
                        <tr>
                            <td class="px-6 py-4">{{ $role->id }}</td>
                            <td class="px-6 py-4">{{ $role->name }}</td>
                            <td class="px-6 py-4">{{ $role->permissions->pluck('name')->implode(',') }}</td>
                            <td class="px-6 py-4">{{\Carbon\Carbon::parse( $role->created_at)->format('d M, Y')}}</td>

                            <td class="px-6 py-4">
                                <!-- Flex container for buttons -->
                                <div class="flex space-x-2">
@can('Edit Role')

                                    <!-- Edit Button -->

                                    <a href="{{ route('roles.edit', $role->id) }}" class="bg-slate-700 text-sm rounded-md px-3 py-2 hover:bg-slate-600">Edit</a>


@endcan

@can('Delete Role')
<form action="{{ route('roles.destroy', $role->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-600 text-sm rounded-md px-3 py-2 hover:bg-red-500" onclick="return confirm('Are you sure you want to delete this role?')">
        Delete
    </button>
</form>


@endcan




                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No Roles found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
           {{ $roles->links() }}
        </div>
    </div>
</x-app-layout>
