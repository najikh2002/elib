@props(['value'])

<label {{ $attributes->merge(['class' => 'text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>


