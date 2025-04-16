<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create Product</h1>

        <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="flex space-x-4">
                <!-- Name -->
                <div class="flex-1">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <!-- RFID Tag -->
                <div class="flex-1">
                    <x-input-label for="rfid_tag" :value="__('RFID Tag')" />
                    <x-text-input id="rfid_tag" name="rfid_tag" type="text" class="mt-1 block w-full" :value="old('rfid_tag')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('rfid_tag')" />
                </div>
            </div>

            <div class="flex space-x-4">
                <!-- Price -->
                <div class="flex-1">
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price')" required step="0.01" />
                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                </div>

                <!-- Size Dropdown -->
                <div class="flex-1">
                    <x-input-label for="size" :value="__('Size')" />
                    <select id="size" name="size" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                        <option value="">Select Size</option>
                        <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>S</option>
                        <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>M</option>
                        <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>L</option>
                        <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>XL</option>
                        <option value="XXL" {{ old('size') == 'XXL' ? 'selected' : '' }}>XXL</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('size')" />
                </div>
            </div>

            <div class="flex space-x-4">
                <!-- Category Dropdown -->
                <div class="flex-1">
                    <x-input-label for="category" :value="__('Category')" />
                    <select id="category" name="category" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                        <option value="">Select Category</option>
                        <option value="Men" {{ old('category') == 'Men' ? 'selected' : '' }}>Men</option>
                        <option value="Women" {{ old('category') == 'Women' ? 'selected' : '' }}>Women</option>
                        <option value="Kid" {{ old('category') == 'Kid' ? 'selected' : '' }}>Kid</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('category')" />
                </div>

                <!-- Type Dropdown -->
                <div class="flex-1">
                    <x-input-label for="type" :value="__('Type')" />
                    <select id="type" name="type" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                        <option value="">Select Type</option>
                        <option value="Top Wear" {{ old('type') == 'Top Wear' ? 'selected' : '' }}>Top Wear</option>
                        <option value="Bottom Wear" {{ old('type') == 'Bottom Wear' ? 'selected' : '' }}>Bottom Wear</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('type')" />
                </div>
            </div>

            <!-- Location Dropdown -->
            <div>
                <x-input-label for="location" :value="__('Location')" />
                <select id="location" name="location" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="">Select Location</option>
                    <option value="Room A" {{ old('location') == 'Room A' ? 'selected' : '' }}>Room A</option>
                    <option value="Room B" {{ old('location') == 'Room B' ? 'selected' : '' }}>Room B</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <x-primary-button>
                    {{ __('Create Product') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
