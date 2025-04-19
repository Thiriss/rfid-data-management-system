<x-app-layout>
    <div class="container mx-auto px-6 py-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">RFID Tag Locations</h1>
        </div>

        <!-- Realtime Tag Data Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">No</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Tag ID</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Location</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody id="tagTableBody" class="text-sm">
                     @forelse($rfidData as $index => $tag)
                        <tr class="border-b" data-tag-id="{{ $tag->tag_id }}">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $tag->tag_id }}</td>
                            <td class="px-4 py-2 location">{{ $tag->location }}</td>
                            <td class="px-4 py-2">
                             <!--    <a href="{{ route('dashboard.details', $tag->tag_id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    View
                                </a> -->
                                 <a href="{{ route('dashboard.details', $tag->tag_id) }}">
                                        <x-primary-button>
                                            View Details
                                        </x-primary-button>
                                 </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-500 py-4">Waiting for data...</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Echo and JS script -->
    <script>
       document.addEventListener("DOMContentLoaded", function () {
    const channel = window.Echo.channel('iot-data');

    channel.listen('MessageEvent', (event) => {
        const data = event.message;
        const tagId = data.tag_id;
        const location = data.location;

        const tableBody = document.getElementById('tagTableBody');
        
        // Remove "waiting for data" row if present
        const waitingRow = document.querySelector('#tagTableBody tr td[colspan="3"]');
        if (waitingRow) {
            waitingRow.closest('tr').remove();
        }

        const existingRow = document.querySelector(`#tagTableBody tr[data-tag-id="${tagId}"]`);

        if (existingRow) {
            existingRow.querySelector('td.location').innerText = location;

            // Highlight update row
            existingRow.classList.add('bg-yellow-100');
            setTimeout(() => {
                existingRow.classList.remove('bg-yellow-100');
            }, 2000); // revert back after 2 seconds
        } else {
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-tag-id', tagId);
            newRow.classList.add('border-b'); // highlight new row
            newRow.classList.add('bg-green-100'); // highlight new row

            const detailsUrl = `/dashboard/details/${tagId}`;
            newRow.innerHTML = `
                <td class="px-4 py-2">${tableBody.children.length + 1}</td>
                <td class="px-4 py-2">${tagId}</td>
                <td class="px-4 py-2 location">${location}</td>
                <td class="px-4 py-2">
                    <a href="${detailsUrl}">
                        <x-primary-button>
                            View Details
                        </x-primary-button>
                    </a>
                </td>
            `;
            tableBody.appendChild(newRow);

            // Remove highlight after 2 seconds
            setTimeout(() => {
                newRow.classList.remove('bg-green-100');
            }, 2000);
        }
    });
});

    </script>
</x-app-layout>
