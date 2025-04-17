<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create RFID</h1>

        <form action="{{ route('rfids.store') }}" method="POST" class="space-y-6"">
            @csrf

            <div class="flex space-x-4">
                <div class="flex-1">
                <x-input-label for="tag_id" value="Tag ID" />
                <x-text-input id="tag_id" name="tag_id" type="number" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('tag_id')" />           
            </div>
            </div>

            <div class="flex space-x-4">
                <div class="flex-1">
                <x-input-label for="product_id" value="Assign to Product" />
                <select id="product_id" name="product_id" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="">-- Optional --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('product_id')" />
            </div>
        </div>

            <div class="flex space-x-4">
                <div class="flex-1">
                <x-input-label for="status" value="Status" />
                <select id="status" name="status" class="mt-1 block w-full form-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
            </div>
            </div>
            <div class="mt-4">
                <x-primary-button>
                    {{ __('Create RFID') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Add New RFID Tag</h2>
    </x-slot>

    <div class="py-6 px-4">
        <form method="POST" action="{{ route('rfids.store') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="tag_id" value="Tag ID" />
                <x-text-input id="tag_id" name="tag_id" type="text" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('tag_id')" />
            </div>

            <div class="mb-4">
                <x-input-label for="product_id" value="Assign to Product" />
                <select id="product_id" name="product_id" class="mt-1 block w-full">
                    <option value="">-- Optional --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('product_id')" />
            </div>

            <div class="mb-4">
                <x-input-label for="status" value="Status" />
                <select id="status" name="status" class="mt-1 block w-full">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
            </div>

            <x-primary-button>Save RFID</x-primary-button>
        </form>
    </div>
</x-app-layout> --}}
