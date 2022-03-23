<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Zone') }}
            <x-link :href="route('zone.index')" class="ml-4">Go Back</x-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('zone.store') }}">
                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="name" class="mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <x-label for="leader" :value="__('Zone Leader')" />
                                    <x-select class="w-full" name="leader" id="leader">
                                        <option value="">-- Select --</option>
                                        @foreach($data as $i => $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </x-select>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <x-label for="note" :value="__('Note / Landmark')" />
                                <x-input id="note" class="mt-1 w-full" type="text" name="note" :value="old('note')" autofocus />
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <x-button class="mt-4">Submit</x-button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
