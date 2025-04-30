<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Product</h1>

        <div class="flex flex-col md:flex-row md:space-x-10">
            <!-- Form Section -->
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" class="w-full md:w-1/2">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        value="{{ old('name', $product->name) }}" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

             <div class="mt-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                            <option value="">Select Category</option>
                            @foreach(['Men', 'Women', 'Kid'] as $cat)
                                <option value="{{ $cat }}" {{ old('category', $product->category) === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('category')" />
                </div>

                <!-- Price & Size -->
                <div class="flex space-x-4 mt-4">
                    <div class="flex-1">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full"
                            value="{{ old('price', $product->price) }}" required />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>
                    <div class="flex-1">
                        <x-input-label for="quantity" :value="__('Quantity')" />
                        <x-text-input id="quantity" name="quantity" type="number" step="0.01" class="mt-1 block w-full"
                            value="{{ old('quantity', $product->quantity) }}" required />
                        <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                    </div>

                </div>

                <!-- Category & Type -->
                <div class="flex space-x-4 mt-4">
                    <div class="flex-1">
                        <x-input-label for="size" :value="__('Size')" />
                        <select id="size" name="size" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                            <option value="">Select Size</option>
                            @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                <option value="{{ $size }}" {{ old('size', $product->size) === $size ? 'selected' : '' }}>
                                    {{ $size }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('size')" />
                    </div>

                    <div class="flex-1">
                        <x-input-label for="type" :value="__('Type')" />
                        <select id="type" name="type" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                            <option value="">Select Type</option>
                            @foreach(['Top Wear', 'Bottom Wear'] as $type)
                                <option value="{{ $type }}" {{ old('type', $product->type) === $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>
                </div>
              <!-- Image Upload -->
               <div class="mt-4">
                <x-input-label for="image" :value="__('Upload New Image')" />
                <input id="image" name="image" type="file" class="mt-1 block w-full" accept="image/*" />
                @if ($product->image)
                    <p class="text-sm text-gray-500 mt-1">Current File: 
                        <a href="{{ asset('storage/' . $product->image) }}" target="_blank" class="text-blue-600 underline">
                            {{ basename($product->image) }}
                        </a>
                    </p>
                @endif
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                <!-- Submit -->
                <div class="mt-6">
                    <x-primary-button>{{ __('Update Product') }}</x-primary-button>
                </div>
          
             </div>
      </form>
            <!-- Right Section: Image Preview -->
            <div class="w-full md:w-1/2 mt-6 md:mt-0">
                <!-- Existing Image -->
                @if ($product->image)
                    <div id="existing-image" class="border rounded-md overflow-hidden shadow-md mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Product Image" class="w-full object-cover max-h-100" />
                    </div>
                @endif

                <!-- Preview for new upload -->
                <div id="preview-container" class="hidden border rounded-md overflow-hidden shadow-md mb-4">
                    <img id="preview-image" src="" alt="New Image Preview" class="w-full object-cover max-h-100" />
                </div>
            </div>
    </div>
</div>

    <!-- JS for Image Preview -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const existingImageContainer = document.getElementById('existing-image');

        // Check if there's already an image
        if (existingImageContainer && !imageInput.value) {
            previewContainer.classList.add('hidden');
        }

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                // Hide the existing image if a new one is chosen
                existingImageContainer?.classList.add('hidden');

                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                // Reset if no file chosen
                previewImage.src = '';
                previewContainer.classList.add('hidden');
                if (existingImageContainer) {
                    existingImageContainer.classList.remove('hidden');
                }
            }
        });
    });
</script>
</x-app-layout>
