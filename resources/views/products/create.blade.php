<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product/Create
        </h2>
        <a href="{{route('products.index')}}" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">back</a>
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                                                       <!-- Form to Create a Permission -->
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <!-- Name Field -->
                        <div class="mb-4">
                            <label class="text-lg font-medium">Name:</label>
                            <div class="my-3">
                                <input value="{{ old('name') }}" type="text" name="name" id="name" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Name">
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Quantity Field -->
                        <div class="mb-4">
                            <label class="text-lg font-medium">Quantity:</label>
                            <div class="my-3">
                                <input value="{{ old('quantity') }}" type="number" name="quantity" id="quantity" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Quantity">
                            </div>
                            @error('quantity')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price Field -->
                        <div class="mb-4">
                            <label class="text-lg font-medium">Price:</label>
                            <div class="my-3">
                                <input value="{{ old('price') }}" type="text" name="price" id="price" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Price">
                            </div>
                            @error('price')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="">
                          <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Submit Product</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
