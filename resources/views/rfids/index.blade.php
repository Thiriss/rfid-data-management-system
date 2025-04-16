<x-app-layout>
    <div class="container mx-auto px-6 py-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">RFID Data</h1>
        </div>
            @if ($rfidData->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>RFID</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rfidData as $data)
                        <tr>
                            <td>{{ $data->rfid }}</td>
                            <td>{{ $data->location }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>No RFID data available.</p>
            @endif
    </div>
</x-app-layout>
