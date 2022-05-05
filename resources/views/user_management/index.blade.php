<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
            <x-link :href="route('user-management.create')" class="ml-4">Add User</x-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-table>
                <x-slot name="head">
                    <x-thead>Name</x-thead>
                    <x-thead>Email</x-thead>
                    <x-thead>Role</x-thead>
                    <x-thead>Zone</x-thead>
                    <x-thead>Action</x-thead>
                </x-slot>
                <x-slot name="body">
                    @foreach ($data as $i => $d)
                        <x-trow>
                            <x-tdata>
                                @if($d->resident)
                                    {{ $d->resident->last_name }}, {{ $d->resident->first_name }}
                                @else
                                    'N/a'
                                @endif
                            </x-tdata>
                            <x-tdata>{{ $d->email }}</x-tdata>
                            <x-tdata>{{ $d->role }}</x-tdata>
                            <x-tdata>{{ $d->zone ? $d->zone->name : 'N/A' }}</x-tdata>
                            <x-tdata>
                                <x-a-tag :href="route('user-management.edit',$d->id)">Edit</x-a-tag>
                                -
                                <x-a-tag :data-url="route('user-management.destroy',$d->id)" class="delete_btn cursor-pointer">Delete</x-a-tag>
                            </x-tdata>
                        </x-trow>
                    @endforeach                    
                </x-slot>
            </x-table>
        </div>
    </div>
</x-app-layout>
