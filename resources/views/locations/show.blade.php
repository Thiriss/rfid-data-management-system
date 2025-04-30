<x-app-layout>
    <div class="container mx-auto px-6 py-6">
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">RFID List in "{{ $location }}"</h1>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 overflow-x-auto">
            <table class="w-full table-auto text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-800 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Tag ID</th>
                        <th class="px-4 py-3">Product Name</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Size</th>
                        <th class="px-4 py-3">Price</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($rfids as $index => $rfid)
                        <tr>
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $rfid->tag_id }}</td>
                            <td class="px-4 py-3">{{ $rfid->product_name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $rfid->category ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $rfid->type ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $rfid->size ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $rfid->price ? number_format($rfid->price, 2) . ' THB' : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">No RFID tags found in this location.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('locations.index') }}" class="inline-block bg-gray-600 hover:bg-gray-400 text-white px-4 py-2 rounded-md">
                Back to Location List
            </a>
        </div>
    </div>
</x-app-layout>
