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
                    <x-thead>Zone</x-thead>
                    <x-thead>Phone Number</x-thead>
                    <x-thead>Age</x-thead>
                    <x-thead>Action</x-thead>
                </x-slot>
                <x-slot name="body">
                    @foreach ($data as $i => $d)
                        <x-trow>
                            <x-tdata>{{ $d->full_name }}</x-tdata>
                            <x-tdata>{{ $d->zone->name }}</x-tdata>
                            <x-tdata>{{ $d->phone_number }}</x-tdata>
                            <x-tdata>{{ $d->age }}</x-tdata>
                            <x-tdata>
                                <x-a-tag :href="route('resident.edit',$d->id)">Edit</x-a-tag>
                                -
                                <x-a-tag :data-url="route('resident.destroy',$d->id)" class="delete_btn cursor-pointer">Delete</x-a-tag>
                            </x-tdata>
                        </x-trow>
                    @endforeach  
                </x-slot>
            </x-table>
        </div>
    </div>
</x-app-layout>
