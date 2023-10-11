<div>

    <livewire:admin />

    <div class="overflow-x-auto" id="dashboard">
        <div class="flex justify-start gap-4 mt-4">
            <div class="text-right bg-primary-blue rounded-2xl text-primary-lite p-4 shadow-lg ">
                Total :
                <span class="text-4xl font-black">{{$all_client->count()}}</span>
            </div>
            <div class="text-right rounded-2xl text-black/70 p-4 shadow-lg ">
                Complete :
                <span class="text-2xl font-bold block">{{$all_client->where('active_status','activated')->count()}}</span>
            </div>
            <div class="text-right rounded-2xl text-black/70 p-4 shadow-lg ">
                Waiting :
                <span class="text-2xl font-bold block">{{$all_client->where('active_status','<>','activated')->count()}}</span>
            </div>
        </div>

        <div class="text-primary-blue flex flex-wrap gap-2 my-4">
            <div class="flex gap-2">
                <span>รับคำปรึกษาและเข้าร่วมโปรแกรม Super TRIO <br>
                    <x-badge label="(Get free consultation and a tablet)"/></span>
                <span class="font-bold text-xl text-black/70">
                    {{$all_client->where('option_1','1')->count()}}
                </span>
            </div>
            <div class="flex gap-2">
                <span>รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 1 เดือน <br>
                    <x-badge label="(Extra tablet sold)"/></span>
                <span class="font-bold text-xl text-black/70">
                    {{$all_client->where('option_2','1')->count()}}
                </span>
            </div>
            <div class="flex gap-2">
                <span>รับสิทธิ์พิเศษเพิ่มเติม - เข้าโปรแกรม 3 เดือน <br>
                    <x-badge label="(Extra box sold)"/></span>
                <span class="font-bold text-xl text-black/70">
                    {{$all_client->where('option_3','>=','1')->count()}}
                </span>
            </div>

        </div>

        <div class="mt-7  overflow-x-auto">
            <table class="table-fixed min-w-full whitespace-nowrap">
                <thead>
                    <tr class="border border-primary-blue bg-primary-blue text-primary-lite text-xs">
                        <th class="w-8">
                            <div class="grid">
                                <x-button flat white right-icon="{{$sort_icon['id']}}" class="w-full block hover:bg-white/10" wire:click="order('id')" label="ลำดับ" />
                                <x-badge primary label="No" />
                            </div>

                        </th>
                        <th class="hidden sm:table-cell">

                            <div class="grid">
                                <x-button flat white right-icon="{{$sort_icon['updated_at']}}" class="w-full block hover:bg-white/10" wire:click="order('updated_at')" label="วันที่" />
                                <x-badge primary label="Date" />
                            </div>
                        </th>
                        <th class="hidden sm:table-cell">

                            <div class="grid">
                                <x-button flat white right-icon="{{$sort_icon['vet_id']}}" class="w-full block hover:bg-white/10" wire:click="order('vet_id')" label="ชื่อคลินิก" />
                                <x-badge primary label="Clinic/Hospital" />
                            </div>
                        </th>
                        <th class="">

                            <div class="grid">
                                <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="ชื่อลูกค้า" />
                                <x-badge primary label="Pet owner's Name" />
                            </div>
                        </th>
                        <th class="hidden sm:table-cell">
                            <div class="grid">
                                <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="น้ำหนัก สุนัข" />
                                <x-badge primary label="Pet's weight" />
                            </div>
                        </th>
                        <th class="hidden sm:table-cell">
                            <div class="grid">
                                <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="สถานะ" />
                                <x-badge primary label="Status" />

                            </div>
                        </th>
                        <th class="hidden sm:table-cell">
                            <div class="grid">
                                <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="สิทธิ์ทั้งหมด" />
                                <x-badge primary label="All Quota" />
                            </div>
                        </th>
                        <th class="hidden sm:table-cell">
                            <div class="grid">
                                <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="สิทธิ์คงเหลือ" />
                                <x-badge primary label="Remaining Quota" />
                            </div>
                        </th>
                        <th class="hidden sm:table-cell">
                            <div class="grid">
                                <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="สิทธิ์ที่รับแล้ว" />
                                <x-badge primary label="Redeemed" />
                            </div>
                        </th>
                        <th class="hidden sm:table-cell">
                            <div class="grid">
                                <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="สินค้าขาด" />
                                <x-badge primary label="Out of quota" />
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                    <tr class="border border-primary-blue p-2">
                        <td class="align-top border border-primary-blue p-2">
                            {{$client->client_code}}
                        </td>
                        <td class="align-top sm:border border-primary-blue p-2 ml-2 table sm:table-cell">
                            {{Carbon\Carbon::parse($client->updated_at)->format('d/m/y')}}
                        </td>
                        <td class="align-top sm:border border-primary-blue p-2 ml-2 table sm:table-cell">
                            <a href="{{route('admin.vetSingle',[$client->vet_id])}}">
                                {{$client->vet->vet_name??$client->vet_id}}
                            </a>
                        </td>
                        <td class="align-top sm:border border-primary-blue p-2 ml-2 table sm:table-cell">
                            {{$client->name}}
                        </td>
                        <td class="align-top sm:border border-primary-blue p-2 ml-2 table sm:table-cell">
                            <span class="sm:hidden inline-block min-w-max mr-2">น้ำหนัก สุนัข</span>
                            {{$client->pet_weight}}
                        </td>
                        <td class="align-top sm:border border-primary-blue p-2 ml-2 table sm:table-cell">
                            <span class="sm:hidden inline-block min-w-max mr-2">สถานะ</span>
                            {{$client->active_status}}
                        </td>
                        <td class="align-top sm:border border-primary-blue p-2 ml-2 table sm:table-cell">
                            <!-- สิทธิ์ทั้งหมด -->
                            <!-- total stock a -->
                            <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์ทั้งหมด</span>
                            {{ $client->vet_stock }}
                        </td>
                        <td class="align-top sm:border border-primary-blue p-2 ml-2 table sm:table-cell">
                            <!-- สิทธิ์ลงเหลือ -->
                            <!-- total stock - total activate -->
                            <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์คงเหลือ</span>
                            {{ $client->vet_stock - $client->vet_total_activated}}
                        </td>
                        <td class="align-top sm:border border-primary-blue p-2 ml-2 table sm:table-cell">
                            <!-- สิทธิ์ที่รับแล้ว	 -->
                            <!-- total activate -->
                            <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์ที่รับแล้ว</span>
                            {{
                            $client->vet_total_activated
                        }}
                        </td>
                        <td class="align-top sm:border border-primary-blue p-2 ml-2 table sm:table-cell">
                            <span class="sm:hidden inline-block min-w-max mr-2">สินค้าขาด</span>

                            @if ($client->vet_stock - $client->vet_total_activated - $client->vet_total_pending < 0 ) <span class="text-red-400"> {{ $client->vet_stock - $client->vet_total_activated - $client->vet_total_pending }} </span>
                                @else
                                0
                                @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="my-4">
                {{$clients->links()}}
            </div>
        </div>
    </div>
</div>