<div>
<div class="mb-4">
    <!-- <x-input label="name" wire:model="name" /> -->
    <x-input label="email" wire:model="email" />
    <x-input type="password" label="password" wire:model="password" />
    <x-input type="password" label="password_confirmation" wire:model="password_confirmation" />
</div>

<div class="mb-4">

    <x-input label="ชื่อโรงพยาบาล" wire:model="vet_name" />
    <x-input label="รหัสโรงพยาบาล" wire:model="vet_id" />
    <div class="mt-4">
        <x-native-select
            label="จังหวัด"
            placeholder="เลือกจังหวัด"
            :options="$addr['Province']"
            option-label="Province"
            option-value="Province"
            wire:model="vet_province"
        />
    </div>
    @if ($vet_province!=null)
        <div class="mt-4">
            <x-native-select
                label="อำเภอ"
                placeholder="เลือกอำเภอ"
                :options="$addr['District']"
                option-label="District"
                option-value="District"
                wire:model="vet_city"
            />
        </div>
    @endif

    @if ($vet_city!=null)
        <div class="mt-4">
            <x-native-select
                label="ตำบล"
                placeholder="เลือกตำบล"
                :options="$addr['Tambon']"
                option-label="Tambon"
                option-value="Tambon"
                wire:model="vet_area"
            />
        </div>
    @endif

</div>

    <x-button lg right-icon="chevron-right" primary
                wire:click="save" type="button" label="register" />
</div>
