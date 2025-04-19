<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create Product</h1>

        <div class="flex flex-col md:flex-row md:space-x-10">
            <!-- Form Section -->
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="w-full md:w-1/2">
                @csrf

                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mt-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                            <option value="">Select Category</option>
                            @foreach(['Men', 'Women', 'Kid'] as $cat)
                                <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
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
                        <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" value="{{ old('price') }}" required />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>
                    <div class="flex-1">
                        <x-input-label for="quantity" :value="__('Quantity')" />
                        <x-text-input id="quantity" name="quantity" type="number" step="0.01" class="mt-1 block w-full" value="{{ old('quantity') }}" required />
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
                                <option value="{{ $size }}" {{ old('size') === $size ? 'selected' : '' }}>
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
                                <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>
                </div>
        
                 <!-- Image Upload -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Upload Image')" />
                    <input id="image" name="image" type="file" class="mt-1 block w-full" accept="image/*" />
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                </div>
                
                <!-- Submit -->
                <div class="mt-6">
                    <x-primary-button>{{ __('Create Product') }}</x-primary-button>
                </div>
            </form>
            <!-- Right Section: Image Preview -->
            <div class="w-full md:w-1/2 mt-6 md:mt-0">
               
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

            imageInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImage.src = '';
                    previewContainer.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
