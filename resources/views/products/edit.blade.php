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
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
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

                                               <!-- Photo Field -->

                        <div class="mb-4">
                            <label for="photo" class="text-lg font-medium">Photo:</label>
                            <input type="file" name="photo" id="photo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('photo')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                <!-- Existing Photo Preview -->
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover">
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
