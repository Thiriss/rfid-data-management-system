<x-app-layout>
    <div class="container mx-auto px-6 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Product Details</h1>
            <p class="text-gray-500">Details for: <span class="font-semibold">{{ $product->name }}</span></p>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Product Detail Card -->
            <div class="bg-white rounded-lg shadow-md p-6 lg:w-1/2">
            <div class="space-y-4">
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Name:</span>
                    <span class="text-gray-800">{{ $product->name }}</span>
                </div>

                @if($product->category)
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Category:</span>
                    <span class="text-gray-800">{{ $product->category }}</span>
                </div>
                @endif

                @if($product->type)
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Type:</span>
                    <span class="text-gray-800">{{ $product->type }}</span>
                </div>
                @endif

                @if($product->size)
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Size:</span>
                    <span class="text-gray-800">{{ $product->size }}</span>
                </div>
                @endif

                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Quantity:</span>
                    <span class="text-gray-800">{{ $product->quantity }}</span>
                </div>

                @if($product->price)
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Price:</span>
                    <span class="text-gray-800">${{ number_format($product->price, 2) }}</span>
                </div>
                @endif

                @if($product->image)
                <div class="flex flex-col">
                    <span class="w-32 font-medium text-gray-700 mb-2">Image:</span>
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="Product Image"
                         class="w-full max-w-xs rounded-lg shadow">
                </div>
                @endif
            </div>



           <!-- Back Button -->
        <div class="mt-8 flex space-x-4">
            <a href="{{ route('products.edit', $product->id) }}"
               class="inline-block bg-red-800 text-white px-4 py-2 rounded hover:bg-blue-700">
                Edit
            </a>
            <a href="{{ route('products.index') }}"
               class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-400">
                Back to List
            </a>
        </div>
        </div>
         <!-- RFID List Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4"> RFID Tag List</h2>

                @if($product->rfids->count())
                    <table class="min-w-full text-sm text-left border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Tag ID</th>
                                <th class="px-4 py-2 border">Location</th>
                                <th class="px-4 py-2 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->rfids as $index => $rfid)
                                <tr class="border-t">
                                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border">{{ $rfid->tag_id }}</td>
                                    <td class="px-4 py-2 border"> {{ $rfid->latestLocation->location ?? '-' }}</td>
                                    <td class="px-4 py-2 border">{{ $rfid->latestLocation->status ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500">No RFID tags assigned to this product.</p>
                @endif
            </div>
    </div>
</div>
</x-app-layout>
