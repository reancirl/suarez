<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Residents') }}
            <x-link :href="route('resident.create')" class="ml-4">Add Resident</x-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-table>
                <x-slot name="head">
                    <x-thead>Name</x-thead>
                    <x-thead class="hidden sm:inline-grid">Zone</x-thead>
                    <x-thead>Age</x-thead>
                    <x-thead class="hidden sm:inline-grid">Phone Number</x-thead>
                    <x-thead>Action</x-thead>
                </x-slot>
                <x-slot name="body">
                    @foreach ($data as $i => $d)
                        <x-trow>
                            <x-tdata>{{ $d->full_name }}</x-tdata>
                            <x-tdata class="hidden sm:inline-grid">{{ $d->zone ? $d->zone->name : 'Zone Deleted' }}</x-tdata>
                            <x-tdata>{{ $d->age }}</x-tdata>
                            <x-tdata class="hidden sm:inline-grid">{{ $d->phone_number }}</x-tdata>
                            <x-tdata>
                                @if( auth()->user()->role == 'admin' || auth()->user()->role == 'official' )
                                    <x-a-tag :href="route('resident.edit',$d->id)" class="cursor-pointer">Edit</x-a-tag>
                                    -
                                    <x-a-tag :data-url="route('resident.destroy',$d->id)" class="delete_btn cursor-pointer">Delete</x-a-tag>
                                @else
                                    @if( auth()->user()->zone_id == $d->zone_id )
                                        <x-a-tag class="cursor-pointer">Clear Liabilities</x-a-tag>
                                    @else
                                        No Action
                                    @endif
                                @endif
                            </x-tdata>
                        </x-trow>
                    @endforeach  
                </x-slot>
            </x-table>
        </div>
    </div>
</x-app-layout>
