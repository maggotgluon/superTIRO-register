<div>

    <livewire:admin />
    <div class="overflow-x-auto" id="vets">
        <div class="flex justify-start gap-4 my-4">
            <div class="bg-primary-blue rounded-2xl text-primary-lite p-4 shadow-lg flex gap-2">
                Total :
                <span class="text-4xl font-black">
                    {{$total}}
                </span>
            </div>

        </div>
        <div class="w-full overflow-x-auto">
            <table class="table-fixed border-collapse border border-primary-blue whitespace-nowrap min-w-full ">
                <thead>
                    <tr class="border border-primary-blue bg-primary-blue text-primary-lite text-xs">
                        <th class="w-4 sm:w-1/12">
                            <div class="grid">
                            <x-button flat white right-icon="{{$sort_icon['id']}}" class="w-full hover:bg-white/10" wire:click="order('id')" label="รหัส" />
                            <x-badge primary label="Code" />
                            </div>
                        </th>
                        <th class="sm:w-4/12">
                            <div class="grid">
                            <x-button flat white right-icon="{{$sort_icon['vet_name']}}" class="w-full hover:bg-white/10" wire:click="order('vet_name')" label="ชื่อคลินิก" />
                            <x-badge primary label="Clinic/Hospital" />
                            </div>
                        </th>
                        <th class="w-1/12 hidden sm:table-cell">
                            <div class="grid">
                            <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="สิทธิ์ทั้งหมด" />
                            <x-badge primary label="All Quota" />
                            </div>
                        </th>
                        <th class="w-1/12 hidden sm:table-cell">
                            <div class="grid">
                            <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="สิทธิ์ที่รับแล้ว" />
                            <x-badge primary label="Redeemed" />
                            </div>
                        </th>
                        <th class="w-1/12 hidden sm:table-cell">
                            <div class="grid">
                            <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="สิทธิ์คงเหลือ" />
                            <x-badge primary label="Remaining Quota" />
                            </div>
                        </th>
                        <th class="w-1/12 hidden sm:table-cell">
                            <div class="grid">
                            <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="สิทธิ์ที่รอ" />
                            <x-badge primary label="Pending" />
                            </div>
                        </th>
                        <th class="w-1/12 hidden sm:table-cell">
                            <div class="grid">
                            <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="ครั้งที่เติมสิทธิ์" />
                            <x-badge primary label="Quota Redeemed" />
                            </div>
                        </th>
                        <th class="w-1/12 hidden sm:table-cell">
                            <div class="grid">
                            <x-button flat white class="pointer-events-none w-full block hover:bg-white/10" label="สินค้าขาด" />
                            <x-badge primary label="Out of quota" />
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vets as $vet)
                    <tr class="border border-primary-blue">
                        <td class="align-top border border-primary-blue p-2 whitespace-nowrap">
                            <a href="{{route('admin.vetSingle',[$vet->id])}}">{{$vet->user_id}}</a>
                        </td>
                        <td class="align-top sm:border border-primary-blue p-2 ml-2 table w-full sm:w-auto sm:table-cell">
                            <a href="{{route('admin.vetSingle',[$vet->id])}}">{{$vet->vet_name}}
                                <span class="whitespace-nowrap flex">
                                    <x-badge outline label="{{$vet->vet_province}}" />
                                    <x-badge outline label="{{$vet->vet_city}}" />
                                    <x-badge outline label="{{$vet->vet_area}}" />
                                </span>
                            </a>
                        </td>
                        <td class="align-top sm:border border-primary-blue sm:text-right p-2 ml-2 table w-full sm:w-auto sm:table-cell">
                            <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์ทั้งหมด</span>

                            {{$vet->stocks}}
                        </td>
                        <td class="align-top sm:border border-primary-blue sm:text-right p-2 ml-2 table w-full sm:w-auto sm:table-cell">
                            <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์ที่รับแล้ว</span>
                            {{$vet->total_client_opt1}}
                        </td>
                        <td class="align-top sm:border border-primary-blue sm:text-right p-2 ml-2 table w-full sm:w-auto sm:table-cell">
                            <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์คงเหลือ</span>
                            {{ $vet->stocks - $vet->total_client_opt1 }}
                        </td>
                        <td class="align-top sm:border border-primary-blue sm:text-right p-2 ml-2 table w-full sm:w-auto sm:table-cell">
                            <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์ที่รอ</span>
                            {{$vet->total_client_pending+$vet->total_client_await}}
                        </td>
                        <td class="align-top sm:border border-primary-blue sm:text-right p-2 ml-2 table w-full sm:w-auto sm:table-cell">
                            <span class="sm:hidden inline-block min-w-max mr-2">ครั้งที่เติมสิทธิ์</span>
                            {{$vet->stocks_adj}}
                        </td>
                        <td class="align-top sm:border border-primary-blue sm:text-right p-2 ml-2 table w-full sm:w-auto sm:table-cell">
                            <span class="sm:hidden inline-block min-w-max mr-2">สิทธิ์ที่ขาด</span>
                            @if($vet->stocks - $vet->total_client_opt1 - ($vet->vet_total - $vet->total_client_activated) < 0) {{$vet->stocks - $vet->total_client_opt1 - ($vet->vet_total - $vet->total_client_activated) }} @else 0 @endif </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="my-4">
                {{ $vets->links() }}
            </div>
        </div>
    </div>
</div>