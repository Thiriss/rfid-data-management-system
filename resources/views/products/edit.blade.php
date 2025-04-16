<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Product</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name and RFID Tag -->
            <div class="flex space-x-4">
                <!-- Name -->
                <div class="flex-1">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $product->name) }}" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <!-- RFID Tag -->
                <div class="flex-1">
                    <x-input-label for="rfid_tag" :value="__('RFID Tag')" />
                    <x-text-input id="rfid_tag" name="rfid_tag" type="text" class="mt-1 block w-full" value="{{ old('rfid_tag', $product->rfid_tag) }}" required />
                    <x-input-error class="mt-2" :messages="$errors->get('rfid_tag')" />
                </div>
            </div>

            <!-- Price and Size -->
            <div class="flex space-x-4">
                <!-- Price -->
                <div class="flex-1">
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" value="{{ old('price', $product->price) }}" required step="0.01" />
                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                </div>

                <!-- Size Dropdown -->
                <div class="flex-1">
                    <x-input-label for="size" :value="__('Size')" />
                    <select id="size" name="size" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                        <option value="">Select Size</option>
                        <option value="S" {{ old('size', $product->size) == 'S' ? 'selected' : '' }}>S</option>
                        <option value="M" {{ old('size', $product->size) == 'M' ? 'selected' : '' }}>M</option>
                        <option value="L" {{ old('size', $product->size) == 'L' ? 'selected' : '' }}>L</option>
                        <option value="XL" {{ old('size', $product->size) == 'XL' ? 'selected' : '' }}>XL</option>
                        <option value="XXL" {{ old('size', $product->size) == 'XXL' ? 'selected' : '' }}>XXL</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('size')" />
                </div>
            </div>

            <!-- Category and Type -->
            <div class="flex space-x-4">
                <!-- Category Dropdown -->
                <div class="flex-1">
                    <x-input-label for="category" :value="__('Category')" />
                    <select id="category" name="category" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                        <option value="">Select Category</option>
                        <option value="Men" {{ old('category', $product->category) == 'Men' ? 'selected' : '' }}>Men</option>
                        <option value="Women" {{ old('category', $product->category) == 'Women' ? 'selected' : '' }}>Women</option>
                        <option value="Kid" {{ old('category', $product->category) == 'Kid' ? 'selected' : '' }}>Kid</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('category')" />
                </div>

                <!-- Type Dropdown -->
                <div class="flex-1">
                    <x-input-label for="type" :value="__('Type')" />
                    <select id="type" name="type" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                        <option value="">Select Type</option>
                        <option value="Top Wear" {{ old('type', $product->type) == 'Top Wear' ? 'selected' : '' }}>Top Wear</option>
                        <option value="Bottom Wear" {{ old('type', $product->type) == 'Bottom Wear' ? 'selected' : '' }}>Bottom Wear</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('type')" />
                </div>
            </div>

            <!-- Location -->
            <div>
                <x-input-label for="location" :value="__('Location')" />
                <select id="location" name="location" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="">Select Location</option>
                    <option value="Room A" {{ old('location', $product->location) == 'Room A' ? 'selected' : '' }}>Room A</option>
                    <option value="Room B" {{ old('location', $product->location) == 'Room B' ? 'selected' : '' }}>Room B</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <x-primary-button>
                    {{ __('Update Product') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
