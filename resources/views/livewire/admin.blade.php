<nav class="flex justify-start items-center flex-wrap gap-2">
    <x-application-logo class="block h-10 w-auto fill-current text-gray-800" />

    <x-button flat label="dashboard" icon="template" href="{{route('admin.dashboard')}}" />
    <x-button flat label="Vet" icon="shopping-cart" href="{{route('admin.vets')}}" />
    
    <x-button flat label="Download Client Data" icon="download" class="ml-auto"
    href="{{route('dl')}}"/>

    
    <x-dropdown class="ml-auto">
        <x-slot name="trigger">
            <x-button.circle icon="user" label="Options" primary />
        </x-slot>
        
        <x-dropdown.item separator label="Logout" icon="logout" wire:click="logout" />
    </x-dropdown>
    <div class="flex flex-col gap-2 content-end hidden">
        <span class="flex">
            <x-badge icon="home" label="Name" indigo />
            <x-dropdown>
                <!-- <x-dropdown.item label="My Profile" /> -->
                <x-dropdown.item label="Logout" wire:click="logout" />
            </x-dropdown>
        </span>
        <x-badge flat icon="information-circle" info label="id" />
    </div>
</nav>
