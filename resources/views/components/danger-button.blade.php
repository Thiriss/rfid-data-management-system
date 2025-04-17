<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md text-xs font-semibold uppercase tracking-widest transition ease-in-out duration-150',
        'onclick' => "return confirm('Are you sure?')"
    ]) }}
>
    {{ $slot }}
</button>
