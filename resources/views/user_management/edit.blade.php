<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }} {{ $data->name ? '- '.$data->name : ''}}
            <x-link :href="route('user-management.index')" class="ml-4">Go Back</x-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('user-management.update',$data->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="last_name" :value="__('Family Name')" />
                                <x-input id="last_name" class="mt-1 w-full" type="text" name="last_name" :value="$data->resident->last_name" required autofocus />
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="first_name" :value="__('Given Name')" />
                                <x-input id="first_name" class="mt-1 w-full" type="text" name="first_name" :value="$data->resident->first_name" required autofocus />
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="middle_name" :value="__('Middle Name')" />
                                <x-input id="middle_name" class="mt-1 w-full" type="text" name="middle_name" :value="$data->resident->middle_name" autofocus />
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="gender" :value="__('Gender')" />
                                <x-select class="w-full" name="gender" id="gender">
                                    <option value="male" {{ $data->resident->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $data->resident->gender == 'female' ? 'selected' : '' }}>Female</option>
                                </x-select>
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="email" :value="__('Email')" />
                                <x-input id="email" class="mt-1 w-full" type="email" name="email" :value="$data->email" required autofocus />
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="occupation" :value="__('Occupation')" />
                                <x-input id="occupation" class="mt-1 w-full" type="text" name="occupation" :value="$data->resident->occupation" autofocus />
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="civil_status" :value="__('Civil Status')" />
                                <x-select class="w-full" name="civil_status" id="civil_status">
                                    <option value="single" {{ $data->resident->civil_status == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ $data->resident->civil_status == 'married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ $data->resident->civil_status == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed" {{ $data->resident->civil_status == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                </x-select>
                            </div>
                            <div class="w-1/3 px-3 mb-6 md:mb-0">
                                <x-label for="phone_number" :value="__('Phone Number')" />
                                <x-input id="phone_number" class="mt-1 w-full" type="text" name="phone_number" :value="$data->resident->phone_number" autofocus />
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6 mt-3">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="address" :value="__('Address')" />
                                <x-input id="address" class="mt-1 w-full" type="text" name="address" :value="$data->resident->address" autofocus />
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="birthday" :value="__('Date of Birth')" />
                                <x-input id="birthday" class="mt-1 w-full" type="text" datepicker name="birthday" :value="$birthday" required autofocus />                                
                            </div>
                        </div>                    
                        
                        <div class="flex flex-wrap -mx-3 mb-6 mt-3">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="role" :value="__('Role')" />
                                <x-select class="w-full" name="role" id="role">
                                    <option value="leader" {{ $data->role == 'leader' ? 'selected' : '' }}>Leader/President</option>
                                    <option value="official" {{ $data->role == 'official' ? 'selected' : '' }} >Official</option>
                                    <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }} >Admin</option>
                                </x-select>
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0" style="display: {{ $data->role == 'leader' ? 'block' : 'none' }};">
                                <x-label for="password" :value="__('Zone')" class="zone" />
                                <x-select class="w-full zone" name="zone_id">
                                    <option value="">-- Select --</option>
                                    @if($data->zone)
                                        <option value="{{ $data->zone->id }}" selected>{{ $data->zone->name }}</option>
                                    @endif
                                    @foreach($zones as $i => $z)
                                        <option value="{{ $z->id }}">{{ $z->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6 mt-3">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="password" :value="__('Password')" />
                                <x-input id="password" class="mt-1 w-full" type="password" name="password" required autofocus />
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-input id="password_confirmation" class="mt-1 w-full" type="password" name="password_confirmation" required autofocus />
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

    <x-slot name="script">
        <script>
            $(document).ready(function(){
                $('#role').change(function(e) {
                    let val = $(this).val();
                    if(val == 'leader') {
                        $('.zone').show()
                        // $('.zone').prop('required',true)
                    } else {
                        $('.zone').hide()
                        // $('.zone').prop('required',false)

                    }
                })
            })
        </script>
    </x-slot>
</x-app-layout>
