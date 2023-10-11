<div class="py-6 min-h-[50vh] relative">

    <div class="text-center absolute inset-0 z-50" wire:loading.delay.longer>
        <img class="m-auto" src="{{url('/loading.gif')}}"/>
    </div>
    <nav class="flex justify-between">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />

        <div class="flex flex-col gap-2 content-end">
            <span class="flex">
                <x-badge icon="home" label="{{$vet->vet_name}}" indigo />
                <x-dropdown>
                    <!-- <x-dropdown.item label="My Profile" /> -->
                    <x-dropdown.item label="Logout" wire:click="logout" />
                </x-dropdown>
            </span>
            <x-badge flat icon="information-circle" info label="{{$vet->user_id}}" />
        </div>
    </nav>
    <div class="grid sm:grid-cols-2 my-4 gap-4">
        <div>
            <div class="flex gap-2">
                <div class=" rounded-2xl bg-primary-blue text-primary-lite/70 p-4 shadow-lg ">
                    Total :
                    <span class="text-2xl font-bold block">{{$opt_all}}</span>
                </div>
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    Complete :
                    <span class="text-2xl font-bold block">{{$opt_activated}}</span>
                </div>
                <div class=" rounded-2xl text-black/70 p-4 shadow-lg ">
                    Waiting :
                    <span class="text-2xl font-bold block">{{$opt_all - $opt_activated}}</span>
                </div>
            </div>
            <div>
                <p class="mt-4">
                    รับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO 
                    <span class="font-bold text-xl text-black/70">
                        {{$opt_1}}
                    </span>
                </p>
                <p class="mt-2">
                    รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 1 เดือน 
                    <span class="font-bold text-xl text-black/70">
                    {{$opt_2}}
                    </span>
                </p>
                <p class="mt-2">
                    รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 3 เดือน 
                    <span class="font-bold text-xl text-black/70">
                    {{$opt_3}}
                    </span>
                </p>
            </div>
        </div>
        <div class="flex gap-2 h-auto">
            <div class="rounded-2xl text-black/70 p-4 shadow-lg ">
                สินค้าทั้งหมด :
                <span class="text-2xl font-bold block">
                    {{$vet->stock->total_stock}}
                </span>
            </div>
            <div class="rounded-2xl text-black/70 p-4 shadow-lg ">
                จำนวนครั้งที่เติม :
                <span class="text-2xl font-bold block">
                    {{$vet->stock->stock_adj}}
                </span>
            </div>
            <div class="rounded-2xl text-black/70 p-4 shadow-lg ">
                สินค้าคงเหลือ :
                <span class="text-2xl font-bold block">
                    {{$vet->stock->total_stock - $opt_1}}
                </span>
            </div>
            <div class="rounded-2xl bg-red-300 text-black/70 p-4 shadow-lg ">
                สินค้าขาด :
                <span class="text-2xl font-bold block">
                    @if($vet->stock->total_stock - $opt_1 - ($opt_all - $opt_activated) < 0 )
                        {{$vet->stock->total_stock - $opt_1 - ($opt_all - $opt_activated)}}
                    @else
                        -
                    @endif
                </span>
            </div>
        </div>
    </div>
    <div class="">
        <p class="text-center py-4">
            รับคำปรึกษา<br>
            และเข้าร่วมโปรแกรม Super TRIO โปรแกรม<br>
            ปกป้องสุนัขจากปริสิตร้ายที่อันตรายถึงชีวิต
        </p>

            <!-- <x-button wire:click="exportCSV" label="Download"/> -->
        <div class="flex justify-center py-2 ">
            <x-button sm flat label="รอการรับสิทธิ์" wire:click="filter('pending')"/>
            <!-- x-button sm flat label="ระหว่างการรับสิทธิ์"  wire:click="filter('await')"/> -->
            <!-- x-button sm flat label="หมดอายุ"  wire:click="filter('expired')"/> -->
            <x-button sm flat label="การรับสิทธิ์สมบูรณ์"  wire:click="filter('activated')"/>
        </div>

        <div class="min-h-[50vh]">
            @foreach ( $clients as $client)
                @if ($client->active_status==='await')
                    <div class="bg-primary-blue text-white p-4 rounded-2xl  my-2">
                        <x-badge flat label="{{$client->active_status}}" />
                        <h3 class="text-2xl font-bold text-center py-4">{{$client->client_code}}</h3>
                        <p class="pb-2 text-center">
                            ชื่อเจ้าของ {{$client->name}}<br> 
                            เบอร์โทร {{$client->phone}}<br>
                            ชื่อน้อง {{$client->pet_name}}<br>
                            ขนาด {{$client->pet_weight}}
                        </p>
                        <div class="flex justify-center">
                            <x-button lg primary class="font-bold bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl shadow-white"
                            label="รับสิทธิ์" wire:click="approvedClient({{$client->id}})"/>
                        </div>
                    </div>
                @endif
            @endforeach

            @foreach ( $clients as $client)
                @if ($client->active_status==='pending')
                    <div class="bg-gray-dark p-4 rounded-2xl text-content-dark ml-8 my-2 relative">
                        <x-badge flat label="{{$client->active_status}}" class="absolute"/>
                        <!-- <h3 class="text-xl font-bold text-right py-2">{{$client->client_code}}</h3> -->
                        <p class="pb-2 text-right">
                            ชื่อเจ้าของ {{$client->name}}<br> 
                            เบอร์โทร {{$client->phone}}<br>
                            ชื่อน้อง {{$client->pet_name}}
                            ขนาด {{$client->pet_weight}}
                        </p>

                        โทร. {{$client->phone}}
                        <div class="flex justify-end">
                            @if ($client->active_date)
                                <x-badge flat label="{{$client->active_date}}"/>
                            @endif
                            <!-- if($client->active_status === 'expired') -->
                                <!-- <x-button sm primary class="font-bold bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl shadow-white"
                                label="ล้าง" wire:click="revokeClient({{$client->id}})"/> -->
                            <!-- endif -->
                        </div>
                    </div>
                @endif
            @endforeach

            @foreach ( $clients as $client)
                @if ($client->active_status==='expired'||$client->active_status==='activated')
                    <div class="bg-gray-dark p-4 rounded-2xl text-content-dark ml-8 my-2 relative {{$client->active_status==='expired'?'opacity-50':''}}">
                            <x-badge flat label="{{$client->active_status}}" class="absolute"/>
                            <h3 class="text-xl font-bold text-right py-2">{{$client->client_code}}</h3>
                            <p class="pb-2 text-right">
                                ชื่อเจ้าของ {{$client->name}}<br> 
                                เบอร์โทร {{$client->phone}}<br>
                                ชื่อน้อง {{$client->pet_name}}<br>
                                ขนาด {{$client->pet_weight}}
                            </p>
                            <div class="flex justify-end gap-2 items-center">
                                @if ($client->active_date)
                                    <x-badge flat label="{{$client->active_date}}"/>
                                @endif
                                <!-- if($client->active_status === 'expired') -->
                                    <!-- <x-button sm primary class="font-bold bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl shadow-white"
                                    label="ล้าง" wire:click="revokeClient({{$client->id}})"/> -->
                                <!-- endif -->
                            </div>
                        </div>
                @endif
            @endforeach
            
        </div>
    </div>

</div>
