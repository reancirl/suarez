<tr {{ $attributes->merge(['class' => 'border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600']) }}>
    {{ $slot }}
</tr>