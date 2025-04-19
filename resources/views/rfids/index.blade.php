<x-app-layout>
    <div class="container mx-auto px-6 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">RFIDs</h1>
            <a href="{{ route('rfids.create') }}">
                <x-primary-button>
                    {{ __('Add RFID') }}
                </x-primary-button>
            </a>
        </div>
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success bg-green-100 text-green-700 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <!-- Add a number column -->
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">No</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Tag ID</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Product</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Status</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($rfids as $index => $rfid)
                        <tr class="border-b hover:bg-gray-50">
                            <!-- Display the row number -->
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $rfid->tag_id }}</td>
                            <td class="px-4 py-2">{{ $rfid->product->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $rfid->status }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-4">
                                    <a href="{{ route('rfids.edit', $rfid->id) }}">
                                        <x-primary-button>
                                            {{ __('Edit') }}
                                        </x-primary-button>
                                    </a>
                            
                                    <form action="{{ route('rfids.destroy', $rfid->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button>
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </form>
                                </div>
                            </td>
                            
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="mt-4 ">
            {{ $rfids->links() }}
        </div>
</div>
</x-app-layout>
