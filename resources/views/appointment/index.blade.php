<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-table>
                <x-slot name="head">
                    <x-thead>Date</x-thead>
                    <x-thead>Resident</x-thead>
                    <x-thead>Status</x-thead>
                    <x-thead>Zone</x-thead>
                    <x-thead>Action</x-thead>
                </x-slot>
                <x-slot name="body">
                    @foreach ($data as $i => $d)
                        @if($d->resident)
                            <x-trow>
                                <x-tdata>{{ date('M d, Y',strtotime($d->date)) }}</x-tdata>
                                <x-tdata>{{ $d->resident->last_name }}, {{ $d->resident->first_name }} {{ $d->resident->middle_name }}</x-tdata>
                                <x-tdata>{{ $d->status }}</x-tdata>
                                <x-tdata>{{ $d->resident->zone ? $d->resident->zone->name : 'Zone Deleted' }}</x-tdata>
                                <x-tdata>
                                    @if( $d->status == 'cleared' && (auth()->user()->role == 'admin' || auth()->user()->role == 'official') )
                                        <x-a-tag :href="route('appointment.show',$d->id)" target="_blank">Print</x-a-tag>
                                    @elseif(auth()->user()->role == 'leader')
                                    <x-a-tag :href="route('appointment.edit',$d->id)">Update Status</x-a-tag>
                                    @else
                                        No Action
                                    @endif
                                </x-tdata>
                            </x-trow>
                        @endif
                    @endforeach  
                </x-slot>
            </x-table>
        </div>
    </div>
</x-app-layout>
