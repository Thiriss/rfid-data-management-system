<x-app-layout>
    <div class="container mx-auto px-6 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">RFID Details</h1>
            <p class="text-gray-500">Details for Tag ID: <span class="font-semibold">{{ $rfid->tag_id }}</span></p>
        </div>

        <!-- RFID Detail Card -->
        <div class="bg-white rounded-lg shadow-md p-6 max-w-xl">
            <div class="space-y-4">
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Tag ID:</span>
                    <span class="text-gray-800">{{ $rfid->tag_id }}</span>
                </div>

                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Location:</span>
                    <span class="text-gray-800">{{ $rfid->location }}</span>
                </div>

                @if($rfid->status)
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Status:</span>
                    <span class="text-gray-800">{{ $rfid->status }}</span>
                </div>
                @endif

                @if($rfid->name)
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Name:</span>
                    <span class="text-gray-800">{{ $rfid->name }}</span>
                </div>
                @endif

                @if($rfid->category)
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Category:</span>
                    <span class="text-gray-800">{{ $rfid->category }}</span>
                </div>
                @endif

                @if($rfid->type)
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Type:</span>
                    <span class="text-gray-800">{{ $rfid->type }}</span>
                </div>
                @endif

                @if($rfid->size)
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Size:</span>
                    <span class="text-gray-800">{{ $rfid->size }}</span>
                </div>
                @endif

                @if($rfid->price)
                <div class="flex">
                    <span class="w-32 font-medium text-gray-700">Price:</span>
                    <span class="text-gray-800">{{ $rfid->price }}</span>
                </div>
                @endif

            </div>

            <div class="mt-6">
                <a href="{{ route('dashboard') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
