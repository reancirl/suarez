<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
            <x-link :href="route('user-management.index')" class="ml-4">Go Back</x-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="name" :value="__('Full Name')" />
                                <x-input id="name" class="mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="email" :value="__('Email')" />
                                <x-input id="email" class="mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6 mt-3">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="password" :value="__('Password')" />
                                <x-input id="password" class="mt-1 w-full" type="password" name="password" :value="old('password')" required autofocus />
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-input id="password_confirmation" class="mt-1 w-full" type="password" name="password_confirmation" :value="old('password_confirmation')" required autofocus />
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap -mx-3 mb-6 mt-3">
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="role" :value="__('Role')" />
                                <x-select class="w-full" name="role" id="role">
                                    <option value="leader">Leader</option>
                                    <option value="official">Official</option>
                                    <option value="admin">Admin</option>
                                </x-select>
                            </div>
                            <div class="w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="password" :value="__('Zone')" class="zone" />
                                <x-select class="w-full zone" name="zone_id">
                                    <option value="">-- Select --</option>
                                    @foreach($data as $i => $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </x-select>
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

    <x-slot name="script">
        <script>
            $(document).ready(function(){
                $('#role').change(function(e) {
                    let val = $(this).val();
                    if(val == 'leader') {
                        $('.zone').show()
                    } else {
                        $('.zone').hide()
                    }
                })
            })
        </script>
    </x-slot>
</x-app-layout>
