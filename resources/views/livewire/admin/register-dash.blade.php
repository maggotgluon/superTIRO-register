<div>
    <nav class="flex justify-start items-center flex-wrap gap-2">
        <x-application-logo class="block h-10 w-auto fill-current text-gray-800" />
        <div class="ml-auto">
            <x-button flat icon="download" label="download"
                href="{{route('dl')}}"/>
        <x-dropdown>
            <x-slot name="trigger">
                <x-button.circle icon="user" label="Options" primary />
            </x-slot>
            
            <x-dropdown.item separator label="Logout" icon="logout" wire:click="logout" />
        </x-dropdown>
        <div>
    </nav>

<div class="overflow-x-auto py-4" id="dashboard">
    <div>
        <table class="w-full table-fixed">
            <thead>
                <tr class="border border-primary-blue bg-primary-blue text-primary-lite text-xs">
                    <th class="w-4 hidden sm:table-cell">ลำดับ</th>
                    <th class="w-4 hidden sm:table-cell">วันที่</th>
                    <th class="w-4 sm:table-cell">ชื่อลูกค้า</th>
                    <th class="w-4 hidden sm:table-cell">ข้อมูลสุนัข</th>
                    <th class="w-4 hidden sm:table-cell">ชื่อคลินิก</th>
                    <th class="w-4 hidden sm:table-cell">จังหวัด</th>
                </tr>
            </thead>


            <tbody>
                @foreach ($c as $item)
                <tr class="border border-primary-blue">
                    <td class="border sm:border-primary-blue border-t-primary-blue p-2 block sm:table-cell">{{$item->client_code}}</td>
                    <td class="border sm:border-primary-blue p-2 block sm:table-cell">
                        {{Carbon\Carbon::create($item->created_at)->toDayDateTimeString()}}
                    </td>
                    <td class="border sm:border-primary-blue p-2 block sm:table-cell">
                        <ul>
                            <li>{{$item->name}}</li>
                            @isset($item->email)
                                <li><x-button label="{{$item->email}}" href="mailto:{{$item->email}}"/></li>
                            @endisset
                                <li><x-button label="{{$item->phone}}" href="tel:{{$item->phone}}"/></li>
                            
                        </ul>
                    </td>
                    <td class="border sm:border-primary-blue p-2 block sm:table-cell">
                        <ul>
                            <li>ชื่อน้องหมา : {{$item->pet_name}} </li>
                                <li>พันธุ์ : {{$item->pet_breed}}</li>
                                    <li>น้ำหนัก : {{$item->pet_weight}}</li>
                                        <li>อายุ : {{$item->pet_age_year}} ปี {{$item->pet_age_month}} เดือน</li>
                        </ul>
                    </td>
                    <td class="border sm:border-primary-blue p-2 block sm:table-cell">
                        {{$item->vet_name}}
                    </td>
                    <td class="border sm:border-primary-blue p-2 block sm:table-cell">
                        {{App\Models\ThailandAddr::find($item->addr_id)->Province}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
</div>
