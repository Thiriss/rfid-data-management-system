<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Product</h1>

        <div class="flex flex-col md:flex-row space-x-0 md:space-x-10">
            <!-- Form Section -->
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            
                <div class="flex space-x-8">
                    <!-- LEFT SIDE -->
                    <div class="w-1/2">
                        <div class="flex space-x-4 mt-4">
                            <div class="flex-1">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                value="{{ old('name', $product->name) }}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Image Upload -->
                        <div class="flex-1">
                            <x-input-label for="image" :value="__('Upload New Image')" />
                            <input id="image" name="image" type="file" class="mt-1 block w-full" accept="image/*" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>
                        </div>
                        <!-- Price and Size -->
                        <div class="flex space-x-4 mt-4">
                            <div class="flex-1">
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full"
                                    value="{{ old('price', $product->price) }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>
            
                            <div class="flex-1">
                                <x-input-label for="size" :value="__('Size')" />
                                <select id="size" name="size" class="mt-1 block w-full form-select">
                                    <option value="">Select Size</option>
                                    @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                        <option value="{{ $size }}" {{ old('size', $product->size) == $size ? 'selected' : '' }}>
                                            {{ $size }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('size')" />
                            </div>
                        </div>
            
                        <!-- Category and Type -->
                        <div class="flex space-x-4 mt-4">
                            <div class="flex-1">
                                <x-input-label for="category" :value="__('Category')" />
                                <select id="category" name="category" class="mt-1 block w-full form-select">
                                    <option value="">Select Category</option>
                                    @foreach(['Men', 'Women', 'Kid'] as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('category')" />
                            </div>
            
                            <div class="flex-1">
                                <x-input-label for="type" :value="__('Type')" />
                                <select id="type" name="type" class="mt-1 block w-full form-select">
                                    <option value="">Select Type</option>
                                    @foreach(['Top Wear', 'Bottom Wear'] as $type)
                                        <option value="{{ $type }}" {{ old('type', $product->type) == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>
                        </div>
            
                        <!-- Submit -->
                        <div class="mt-6">
                            <x-primary-button>{{ __('Update Product') }}</x-primary-button>
                        </div>
                    </div>
            
                    <!-- RIGHT SIDE -->
                    <div class="w-1/2">
                        @if ($product->image)
                            <div class="border rounded-md overflow-hidden shadow-md mb-4">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-full object-cover" />
                            </div>
                        @else
                            <p class="text-gray-500 mb-4">No image uploaded.</p>
                        @endif
            
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</x-app-layout>
