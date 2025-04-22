<nav class="w-full">
    <ul class="space-y-4">
        <!-- Dashboard -->
        <li>
            <a href="{{ route('dashboard') }}" 
                class="flex items-center px-4 py-2 
                    {{ request()->routeIs('dashboard*') ? 'bg-gray-600 text-white' : 'hover:bg-gray-200' }} 
                    rounded-lg transition">
                <img src="{{ asset('img/home.png') }}" alt="Home" class="w-6 h-6 mr-3">
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Products -->
        <li>
            <a href="{{ route('products.index') }}" 
                class="flex items-center px-4 py-2 
                    {{ request()->routeIs('products*') ? 'bg-gray-600 text-white' : 'hover:bg-gray-200' }} 
                    rounded-lg transition">
                <img src="{{ asset('img/hanger.png') }}" alt="Products" class="w-6 h-6 mr-3">
                <span>Products</span>
            </a>
        </li>

        <!-- RFIDs -->
        <li>
            <a href="{{ route('rfids.index') }}" 
                class="flex items-center px-4 py-2 
                    {{ request()->routeIs('rfids*') ? 'bg-gray-600 text-white' : 'hover:bg-gray-200' }} 
                    rounded-lg transition">
                <img src="{{ asset('img/signal.png') }}" alt="RFIDs" class="w-6 h-6 mr-3">
                <span>RFIDs</span>
            </a>
        </li>
        <!-- Location -->
        <li>
            <a href="{{ route('locations.index') }}" 
                class="flex items-center px-4 py-2 
                    {{ request()->routeIs('locations*') ? 'bg-gray-600 text-white' : 'hover:bg-gray-200' }} 
                    rounded-lg transition">
                <img src="{{ asset('img/location.png') }}" alt="Locations" class="w-6 h-6 mr-3">
                <span>Locations</span>
            </a>
        </li>
    </ul>
</nav>
