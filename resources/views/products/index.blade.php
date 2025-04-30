<x-app-layout>
    <div class="container mx-auto px-6 py-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">All Products</h1>
            <a href="{{ route('products.create') }}">
                <x-primary-button>
                    {{ __('Add Product') }}
                </x-primary-button>
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success bg-green-100 text-green-700 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Products Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <!-- Add a number column -->
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">No</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Name</th>
                        {{-- <th class="px-4 py-2 text-sm font-medium text-gray-600">Image</th> --}}
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Size</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Category</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Type</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Price</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Quantity</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($products as $index => $product)
                        <tr class="border-b hover:bg-gray-50">
                            <!-- Display the row number -->
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $product->name }}</td>
                            {{-- <td class="px-4 py-2">{{ $product->image }}</td> --}}
                            <td class="px-4 py-2">{{ $product->size }}</td>
                            <td class="px-4 py-2">{{ $product->category }}</td>
                            <td class="px-4 py-2">{{ $product->type }}</td>
                            <td class="px-4 py-2">{{ $product->price }} THB</td>
                            <td class="px-4 py-2">{{ $product->quantity }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-4">
                                    <a href="{{ route('products.show', $product->id)}}">
                                        <x-primary-button>
                                            {{ __('View') }}
                                        </x-primary-button>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id)}}">
                                        <x-primary-button>
                                            {{ __('Edit') }}
                                        </x-primary-button>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')                                
                                        <x-danger-button>
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4 ">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
