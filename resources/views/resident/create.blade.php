<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Resident') }}
            <x-link :href="route('resident.index')" class="ml-4">Go Back</x-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('resident.store') }}">
                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="last_name" :value="__('Family Name')" />
                                <x-input id="last_name" class="mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="first_name" :value="__('Given Name')" />
                                <x-input id="first_name" class="mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="middle_name" :value="__('Middle Name')" />
                                <x-input id="middle_name" class="mt-1 w-full" type="text" name="middle_name" :value="old('middle_name')" autofocus />
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6 mt-3">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="gender" :value="__('Gender')" />
                                <x-select class="w-full" name="gender" id="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </x-select>
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="zone_id" :value="__('Zone')" />
                                <x-select class="w-full" name="zone_id" id="zone_id">
                                    @foreach($data as $i => $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap -mx-3 mb-6 mt-3">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="email_address" :value="__('Email Address')" />
                                <x-input id="email_address" class="mt-1 w-full" type="email" name="email_address" :value="old('email_address')" autofocus />
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="birthday" :value="__('Date of Birth')" />
                                <x-input id="birthday" class="mt-1 w-full" type="text" datepicker name="birthday" :value="old('birthday')" required autofocus />                                
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6 mt-3">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <x-label for="address" :value="__('Address')" />
                                <x-input id="address" class="mt-1 w-full" type="text" name="address" :value="old('address')" autofocus />
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="occupation" :value="__('Occupation')" />
                                <x-input id="occupation" class="mt-1 w-full" type="text" name="occupation" :value="old('occupation')" autofocus />
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="civil_status" :value="__('Civil Status')" />
                                <x-select class="w-full" name="civil_status" id="civil_status">
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                </x-select>
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="phone_number" :value="__('Phone Number')" />
                                <x-input id="phone_number" class="mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" autofocus required/>
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
    <script src="https://unpkg.com/flowbite@1.4.1/dist/datepicker.js"></script>
</x-app-layout>
