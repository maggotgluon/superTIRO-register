<div>
    <p>
        กรุณากรอกหมายเลขโทรศัพท์ ที่ลงทะเบียนรับสิทธิ์
    </p>
    @if ($error)
        <p class="text-secondary-red text-center">
            {{$error}}
        </p>
            
    @endif
    <x-input wire:model="phone" label="หมายเลขโทรศัพท์" placeholder="หมายเลขโทรศัพท์" 
    inputmode="tel" type="tel"
    class="{{$error!=''?'ring-secondary-red':''}}"/>

    <div class="py-2 text-center mt-auto flex justify-between items-center">
       
        <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl" 
        wire:click="login" type="button" label="ตรวจสอบ" />
    </div>
</div>
