<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product/Edit
            </h2>
            <a href="{{ route('products.index') }}" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white hover:bg-slate-800">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Form to Edit Product -->
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        <!-- Name Field -->
                        <div class="mb-6">
                            <label for="name" class="text-lg font-medium">Name:</label>
                            <div class="my-3">
                                <input value="{{ old('name', $product->name) }}" type="text" name="name" id="name" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Name">
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Quantity Field -->
                        <div class="mb-6">
                            <label for="quantity" class="text-lg font-medium">Quantity:</label>
                            <div class="my-3">
                                <input value="{{ old('quantity', $product->quantity) }}" type="number" name="quantity" id="quantity" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Quantity">
                            </div>
                            @error('quantity')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price Field -->
                        <div class="mb-6">
                            <label for="price" class="text-lg font-medium">Price:</label>
                            <div class="my-3">
                                <input value="{{ old('price', $product->price) }}" type="text" name="price" id="price" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Price">
                            </div>
                            @error('price')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white hover:bg-slate-800">
                                Update Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
