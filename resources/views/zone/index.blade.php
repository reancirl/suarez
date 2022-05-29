<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zones') }}
            <x-link :href="route('zone.create')" class="ml-4">Add Zone</x-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-table>
                <x-slot name="head">
                    <x-thead>Name</x-thead>
                    <x-thead>Number of Residents</x-thead>
                    <x-thead>Zone Leader</x-thead>
                    <x-thead>Note/Landmark</x-thead>
                    <x-thead>Action</x-thead>
                </x-slot>
                <x-slot name="body">
                    @foreach ($data as $i => $d)
                        <x-trow>
                            <x-tdata>{{ $d->name }}</x-tdata>
                            <x-tdata>{{ $d->residents_count }}</x-tdata>
                            <x-tdata>{{ $d->leader ? $d->leader->resident ? $d->leader->resident->full_name : 'N/A' : 'N/A' }}</x-tdata>
                            <x-tdata>{{ $d->note ?? 'N/A' }}</x-tdata>
                            <x-tdata>
                                <x-a-tag :href="route('zone.edit',$d->id)">Edit</x-a-tag>
                                -
                                <x-a-tag :data-url="route('zone.destroy',$d->id)" class="delete_btn cursor-pointer">Delete</x-a-tag>
                            </x-tdata>
                        </x-trow>
                    @endforeach  
                </x-slot>
            </x-table>
        </div>
    </div>
</x-app-layout>
