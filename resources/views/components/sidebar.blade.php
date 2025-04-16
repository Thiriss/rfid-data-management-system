<div class="w-full">
    <ul class="space-y-4">
        <li class="flex items-center px-4 py-2 hover:bg-gray-200 rounded-lg">
            <img src="{{ asset('img/home.png') }}" alt="Home" class="w-8 h-8 mr-3">
            <a href="{{ route('dashboard') }}" class="text-gray-700">Home</a>
        </li>
        <li class="flex items-center px-4 py-2 hover:bg-gray-200 rounded-lg">
            <img src="{{ asset('img/hanger.png') }}" alt="Products" class="w-6 h-6 mr-3">
            <a href="{{ route('products.index') }}" class="text-gray-700">Products</a>
        </li>
        <li class="flex items-center px-4 py-2 hover:bg-gray-200 rounded-lg cursor-pointer">
            <img src="{{ asset('img/rfid.png') }}" alt="RFIDs" class="w-8 h-8 mr-1">
            <a href="{{ route('rfids.index') }}" class="text-gray-700">RFIDs</a>
        </li>
        
    </ul>
</div>
