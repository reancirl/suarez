<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Holidays') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-4 max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="col-span-2">
            <ol class="list-decimal">
                @foreach ($data as $item)
                    <li class="mb-2 text-lg"> <span class="text-blue-600 cursor-pointer underline underline-offset-1 holiday_btn" data-url="{{ route('holiday.destroy',$item->id) }}">{{ $item->name }}</span> - {{ date('M d, Y',strtotime($item->date)) }}</li>
                @endforeach
            </ol>
        </div>
        <div class="col-span-2 text-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Holiday') }}
            </h2>
            <hr>
            <form method="POST" action="{{ route('holiday.store') }}" class="text-left">
                @csrf
                <x-label for="birthday" :value="__('Name')" class="mt-5"/>
                <x-input id="name" class="mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Holiday Name"/>
                <x-label for="date" :value="__('Date')" class="mt-5"/>
                <x-input id="date" class="mt-1 w-full" type="text" datepicker name="date" :value="old('date')" required autofocus />  
                <x-button class="mt-4">Submit</x-button>
            </form>
        </div>
    </div>
    <form method="POST" id="delete_form">
        @csrf
        @method('delete')
    </form>
    <script src="https://unpkg.com/flowbite@1.4.1/dist/datepicker.js"></script>
    <x-slot name="script">
        <script>
            $(document).ready(function(){
                $('.holiday_btn').click(function(e) {
                    var url = $(this).data('url')
                    if (confirm('Do you want to delete this holiday?') == true) {
                        var form = $('#delete_form')
                        form.attr('action', url)
                        form.submit()
                    }
                })
            })
        </script>
    </x-slot>
</x-app-layout>
