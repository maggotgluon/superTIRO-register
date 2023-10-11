<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-center flex-wrap gap-2">
                    @auth
                        @if (Auth::user()->name == 'admin')
                            <x-button label="Admin Dashboard" href="{{ route('admin.dashboard') }}" />
                        @else
                            <x-button label="Dashboard" href="{{ route('dashboard') }}" />
                        @endif
                    @else
                        <!-- <x-button label="Client Login" href="{{ route('client.login') }}" /> -->
                        <x-button label="Client Register" href="{{ route('client.register') }}" />

                        <x-button label="Vet Login" href="{{ route('vet.login') }}" />
                        {{-- <x-button label="Vet Register" href="{{ route('vet.register') }}" /> --}}
                    @endauth

                </div>

                  <!--  <x-button label="Download all client Data" href="{{ route('dl') }}" /> -->
            </div>
        </div>
    </div>


</x-guest-layout>
