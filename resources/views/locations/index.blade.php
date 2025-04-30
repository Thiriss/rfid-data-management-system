<x-app-layout>
    <div class="container mx-auto px-6 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">RFID Location Summary</h1>
            <p class="text-gray-500">Overview of RFID locations and item counts.</p>
        </div>

        <!-- Location Summary Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <table class="min-w-full">
                <thead>
                    <tr class="text-left text-gray-700 border-b">
                        <th class="py-3 px-4">Location</th>
                        <th class="py-3 px-4">Total Items</th>
                        <th class="py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4">{{ $location->location }}</td>
                            <td class="py-2 px-4">{{ $location->total_items }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('locations.show', ['location' => $location->location]) }}">
                                    <x-primary-button>
                                        View Details
                                    </x-primary-button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
