<nav class="flex justify-start items-center">
    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />

    <x-button label="dashboard" href="#dashboard" />
    <x-button label="Vet" href="#vet" />

    <x-select class="py-4 ml-auto" label="ชื่อคลินิก หรือ โรงพยาบาลสัตว์" placeholder="ชื่อคลินิก หรือ โรงพยาบาลสัตว์" :options="$vet_list" option-label="name" option-value="id" wire:model="VetSelect" />
    <div class="flex flex-col gap-2 content-end ">
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


<div class="overflow-x-auto" id="vets">
    <h2>Page All Vet</h2>

    <div class="flex justify-start gap-4 my-4">
        <div class="bg-primary-blue rounded-2xl text-primary-lite p-4 shadow-lg flex gap-2">
            Total :
            <span class="text-4xl font-black">1,700</span>
        </div>

    </div>
    <div class="w-full">
        <table class="border-collapse border border-primary-blue min-w-full">
            <thead>
                <tr class="border border-primary-blue bg-primary-blue text-primary-lite text-xs">
                    <th class="w-1/12">Code</th>
                    <th class="w-4/12">ชื่อคลินิก</th>
                    <th class="w-1/12 hidden sm:table-cell">จำนวน ที่รอ</th>
                    <th class="w-1/12 hidden sm:table-cell">จำนวน ที่รับแล้ว</th>
                    <th class="w-1/12 hidden sm:table-cell">จำนวน ที่ยกเลิก</th>
                    <th class="w-1/12">จำนวน ครั้งที่ดติม</th>
                    <th class="w-1/12 hidden sm:table-cell">สินค้า คลเหลือ</th>
                    <th class="w-1/12 hidden sm:table-cell">สินค้า ขาด</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vets as $vet)
                <tr class="border border-primary-blue">
                    <td class="border border-primary-blue p-2">{{$vet->id}}</td>
                    <td class="border border-primary-blue p-2">
                        {{$vet->vet_name}}

                        <span class="whitespace-nowrap flex">
                            <x-badge outline label="{{$vet->vet_province}}" />
                            <x-badge outline label="{{$vet->vet_city}}" />
                            <x-badge outline label="{{$vet->vet_area}}" />
                        </span>
                    </td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell"><span class="sm:hidden inline-block min-w-max mr-2">จำนวน ที่รอ</span>{{$vet->client->where('active_status','await')->count()}}</td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell"><span class="sm:hidden inline-block min-w-max mr-2">จำนวน ที่รับแล้ว</span>{{$vet->client->where('active_status','activated')->count()}}</td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell"><span class="sm:hidden inline-block min-w-max mr-2">จำนวน ที่ยกเลิก</span>{{$vet->client->where('active_status','expired')->count()}}</td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell"><span class="sm:hidden inline-block min-w-max mr-2">จำนวน ครั้งที่ดติม</span>{{$vet->client->count()}}</td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell"><span class="sm:hidden inline-block min-w-max mr-2">สินค้า คลเหลือ</span>{{$vet->info?$vet->info->where('meta_name','stock')->first()->meta_value:'-'}}</td>
                    <td class="border sm:border-primary-blue text-right p-2 table w-full sm:w-auto sm:table-cell"><span class="sm:hidden inline-block min-w-max mr-2">สินค้า ขาด</span>{{$vet->info?$vet->info->where('meta_name','stock')->first()->meta_value:'-'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{ $vets->links() }}
        </div>
    </div>
</div>

<div class="overflow-x-auto" id="dashboard">

    <div class="flex justify-start gap-4 mt-4">
        <div class="bg-primary-blue rounded-2xl text-primary-lite p-4 shadow-lg ">
            Total :
            <span class="text-4xl font-black">1,700</span>
        </div>
        <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
            Total :
            <span class="text-2xl font-bold block">1,700</span>
        </div>
        <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
            Total :
            <span class="text-2xl font-bold block">1,700</span>
        </div>
        <div class="bg-red-300 rounded-2xl text-black/70 p-4 shadow-lg ">
            Total :
            <span class="text-2xl font-bold block">1,700</span>
        </div>

    </div>

    <div class="text-primary-blue flex flex-wrap gap-2 my-4">
        <span>
            รับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO <span class="font-bold text-xl text-black/70">1,000</span>
        </span>
        <span>
            รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 1 เดือน <span class="font-bold text-xl text-black/70">500</span>
        </span>
        <span>
            รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 3 เดือน <span class="font-bold text-xl text-black/70">300</span>
        </span>

    </div>

    <div>
        <table class="w-full">
            <thead>
                <tr class="border border-primary-blue bg-primary-blue text-primary-lite text-xs">
                    <th class="w-1/12">ลำดับ</th>
                    <th class="w-1/12 hidden sm:table-cell">วันที่</th>
                    <th class="w-2/12 hidden sm:table-cell">ชื่อคลินิก</th>
                    <th class="w-2/12">ชื่อลูกค้า</th>
                    <th class="w-1/12">น้ำหนัก สุนัข</th>
                    <th class="w-1/12">สถานะ</th>
                    <th class="w-1/12 hidden sm:table-cell">จำนวนครั้งที่เติม</th>
                    <th class="w-1/12 hidden sm:table-cell">สินค้าลงเหลือ</th>
                    <th class="w-1/12 hidden sm:table-cell">สินค้าที่มอบแล้ว</th>
                    <th class="w-1/12">สินค้าขาด</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr class="border border-primary-blue">
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">{{$client->id}}</td>
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">{{Carbon\Carbon::parse($client->updated_at)->format('d/m/y')}}</td>
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">{{$client->vet_id}}</td>
                    <td class="border border-primary-blue p-2 sm:table-cell">{{$client->name}}</td>
                    <td class="border border-primary-blue p-2 text-center sm:table-cell">{{$client->pet_weight}}</td>
                    <td class="border border-primary-blue p-2 text-center sm:table-cell">{{$client->active_status}}</td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">{{$client->info?'1':'0'}}</td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">{{$client->info?'1':'0'}}</td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">{{$client->info?'1':'0'}}</td>
                    <td class="border border-primary-blue p-2 text-right table-row sm:table-cell">{{$client->info?'1':'0'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{ $clients->links() }}
        </div>
    </div>
</div>

<div class="overflow-x-auto" id="vet">
    <h2 class="text-lg text-primary-blue font-bold">
        Vet Name
    </h2>
    <div class="flex justify-between">
        <p>
            Vet address<br>
            <span>tel </span> / <span> site </span>
        </p>
        <span class="rounded-2xl bg-primary-blue text-primary-lite/70 p-4 shadow-lg ">
            รหัส : vet code
        </span>
    </div>
    <hr class="border-2 border-primary-blue my-4" />
    <div class="grid grid-cols-2 my-4 gap-4">
        <div>
            <div class="flex gap-2">
                <div class=" rounded-2xl bg-primary-blue text-primary-lite/70 p-4 shadow-lg ">
                    Total :
                    <span class="text-2xl font-bold block">1,700</span>
                </div>
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    Complete :
                    <span class="text-2xl font-bold block">1,700</span>
                </div>
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    Waiting :
                    <span class="text-2xl font-bold block">1,700</span>
                </div>
                <div class=" rounded-2xl bg-red-300 text-black/70 p-4 shadow-lg ">
                    Cancel :
                    <span class="text-2xl font-bold block">1,700</span>
                </div>
            </div>
                <p class="mt-4">
                    รับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO <span class="font-bold text-xl text-black/70">1,000</span>
                </p>
                <p class="mt-2">
                    รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 1 เดือน <span class="font-bold text-xl text-black/70">500</span>
                </p>
                <p class="mt-2">
                    รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 3 เดือน <span class="font-bold text-xl text-black/70">300</span>
                </p>
        </div>

        <div>

            <div class="flex gap-2 justify-end">
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    สินค้าทั้งหมด :
                    <span class="text-2xl font-bold block">1,700</span>
                </div>
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    จำนวนครั้งที่เติม :
                    <span class="text-2xl font-bold block">1,700</span>
                </div>
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    สินค้าคงเหลือ :
                    <span class="text-2xl font-bold block">1,700</span>
                </div>
                <div class=" rounded-2xl bg-red-300 text-black/70 p-4 shadow-lg ">
                    สินค้าขาด :
                    <span class="text-2xl font-bold block">1,700</span>
                </div>
            </div>

            <div class="text-right rounded-2xl text-black/70 p-4 shadow-lg ">
                <x-inputs.number label="จำนวนสินค้าที่เติม : " />
                <x-button primary class="my-4" label="บันทึก" />
            </div>
        </div>

    </div>
    <div>
        
        <table class="w-full">
            <thead>
                <tr class="border border-primary-blue bg-primary-blue text-primary-lite text-xs">
                    <th class="w-1/12">ลำดับ</th>
                    <th class="w-1/12 hidden sm:table-cell">วันที่</th>
                    <th class="w-2/12">ชื่อลูกค้า</th>
                    <th class="w-2/12">การเลือกรับสิทธิ์</th>
                    <th class="w-1/12">น้ำหนัก สุนัข</th>
                    <th class="w-1/12">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr class="border border-primary-blue">
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">{{$client->id}}</td>
                    <td class="border border-primary-blue p-2 table-row sm:table-cell">{{Carbon\Carbon::parse($client->updated_at)->format('d/m/y')}}</td>
                    <td class="border border-primary-blue p-2 sm:table-cell">{{$client->name}}</td>
                    <td class="border border-primary-blue p-2 sm:table-cell">{{$client->name}}</td>
                    <td class="border border-primary-blue p-2 text-center sm:table-cell">{{$client->pet_weight}}</td>
                    <td class="border border-primary-blue p-2 text-center sm:table-cell">{{$client->active_status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{ $clients->links() }}
        </div>
    </div>
</div>