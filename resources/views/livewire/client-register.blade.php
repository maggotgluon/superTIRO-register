<div class="text-content-dark relative min-h-[50vh]">
    
    @if(!empty($successMessage))
    <div class="alert alert-success">
        msg: {{ $successMessage }}
    </div>
    @endif
    @if ($validate_test===false)
    <span class="absolute top-2 right-2">
        <x-badge negative icon="exclamation" nagative label="SMS verlifacition turn off" />
    </span>
    @endif
    
    <div class="text-center absolute inset-0 z-50 {{$currentStep>1? '' : 'hidden'}}" wire:loading>
        <img class="m-auto" src="{{url('/loading.gif')}}"/>
    </div>
    <div class="flex justify-around relative {{$currentStep>=2? '' : 'hidden'}}">
        <progress value={{$currentStep}} max="5" style="
            position: absolute;
            top: calc(50% - .25rem);
            bottom: calc(50% - .25rem);
            left: auto;
            right: auto;
            height:0.5rem;
            width: calc(100% - 5rem);
            z-index: 0;
        ">
        </progress>
        
        <x-button.circle href="#step-1" label="1" style="aspect-ratio: 1/1; z-index:1;"  class="rounded-full font-bold {{$currentStep!=1? 'text-secondary-red ring ring-gray-dark bg-white' : 'bg-primary-blue  ring ring-primary-blue hover:text-primary-blue text-gray-light'}} {{$currentStep>1?'text-primary-blue ring-primary-blue':''}}" />
        <x-button.circle href="#step-2" label="2" style="aspect-ratio: 1/1; z-index:1;"  class="rounded-full font-bold {{$currentStep!=2? 'text-secondary-red ring ring-gray-dark bg-white' : 'bg-primary-blue  ring ring-primary-blue hover:text-primary-blue text-gray-light'}} {{$currentStep>2?'text-primary-blue ring-primary-blue':''}}" />
        <x-button.circle href="#step-3" label="3" style="aspect-ratio: 1/1; z-index:1;"  class="rounded-full font-bold {{$currentStep!=3? 'text-secondary-red ring ring-gray-dark bg-white' : 'bg-primary-blue  ring ring-primary-blue hover:text-primary-blue text-gray-light'}} {{$currentStep>3?'text-primary-blue ring-primary-blue':''}}" />
        <x-button.circle href="#step-4" label="4" style="aspect-ratio: 1/1; z-index:1;"  class="rounded-full font-bold {{$currentStep!=4? 'text-secondary-red ring ring-gray-dark bg-white' : 'bg-primary-blue  ring ring-primary-blue hover:text-primary-blue text-gray-light'}} {{$currentStep>4?'text-primary-blue ring-primary-blue':''}}" disabled="disabled" />
    </div>


    <div class="setup-content min-h-[70vh] flex flex-col transition-all {{ $currentStep != 1 ? 'hidden' : '' }}" id="step-1">
        <!-- <h3> Step 1</h3> -->
        <!-- $status -->
        <div class="text-center mt-8  py-4">
            ฟรี! ลงทะเบียนรับคำปรึกษา <br>
            และเข้าร่วมโปรแกรม Super TRIO <br>
            โปรแกรมปกป้องสุนัขจากปรสิตร้ายที่อันตรายถึงชีวิต

        </div>
        <div class="grid gap-2 pb-8">
            <p>ข้อมูลเจ้าของสุนัข</p>
            <x-input wire:model.defer="firstname" label="ชื่อ" placeholder="ชื่อ" required />
            <x-input wire:model.defer="lastname" label="นามสกุล" placeholder="นามสกุล" required />
            <x-input wire:model.defer="phone" maxlength="10" minlength="10"
            label="หมายเลขโทรศัพท์" placeholder="หมายเลขโทรศัพท์" pattern="[0-9]*" inputmode="tel" required/>
            <!-- <x-button wire:click="sendCode" type="button" label="Send Code" /> -->
            <x-input wire:model.defer="email" label="อีเมล์" placeholder="อีเมล์" type="email" />
            <div class="flex flex-col justify-center py-2">
                <!-- if ($consent == 1) -->
                <x-toggle lg wire:model.defer="consent" wire:click="openConsent" label="ยินยอมและรับทราบนโยบายคุ้มครองข้อมูลส่วนบุคคล" required />
                <!-- endif -->
                <!-- <x-button flat red label="อ่านเพิ่มเติม นโยบายคุ้มครองข้อมูลส่วนบุคคล" wire:click="openConsent"/> -->

            </div>

            <div class="text-secondary-red text-xs text-center">
                หากลงทะเบียนไม่สำเร็จ <br>
                กรุณาติดต่อ 
                <div class="flex flex-wrap justify-center gap-2 mt-4">
                    <x-button rounded class="m-2 p-2"  green href="https://line.me/ti/p/%40PetsSociety" label="Line : @PetsSociety" />
                    <x-button rounded class="m-2 p-2"  sky href="https://www.facebook.com/PetsSocietybyZoetis" label="facebook.com/PetsSocietybyZoetis" />
                </div>
            </div>
        </div>

        <div class="py-2 text-center mt-auto " wire:loading.remove>
            
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl {{$consent?'':'opacity-50 pointer-events-none'}}" wire:click="firstStepSubmit" type="button" label="ถัดไป" />
            
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

    <div class="setup-content min-h-[70vh] flex flex-col {{ $currentStep != 1.25 ? 'hidden' : '' }}" id="step-1-25">
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl py-2 font-bold text-primary-blue">
                หนังสือขอความยินยอมสำหรับลูกค้า <br>
                บริษัท โซเอทิส (ประเทศไทย) จำกัด <br>
                (Customer Consent Form)
            </h3>
        </div>
        <div class="max-h-[50vh] overflow-scroll p-4">
            <p class="my-4">
                บริษัท โซเอทิส (ประเทศไทย) จำกัด (“<b>บริษัทฯ</b>”) เห็นความสำคัญในการคุ้มครองข้อมูลส่วนบุคคลของท่าน ตามที่กำหนดไว้ในพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 บริษัทฯ จึงได้จัดทำหนังสือขอความยินยอมสำหรับลูกค้าในการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของท่านในฐานะลูกค้า ผู้ใช้สินค้า หรือผู้รับบริการของบริษัท เพื่อขอความยินยอมจากท่านสำหรับวัตถุประสงค์ที่บริษัทฯ ไม่สามารถเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของท่านด้วยฐานทางกฎหมายอื่นได้
            </p>
            <p class="my-4"><b>
                    ข้าพเจ้าให้ความยินยอมต่อบริษัทฯ ในการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้าเพื่อวัตถุประสงค์ต่อไปนี้
                </b></p>
            <p class="my-4">
                เก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้า <b>เพื่อวัตถุประสงค์ในการทำการตลาดและการติดต่อสื่อสารกับข้าพเจ้า ซึ่งบริษัทฯ ไม่สามารถอ้างอิงฐานทางกฎหมายอื่นได้</b> เช่น การแจ้งข่าวสารด้านการตลาด การทำการตลาดแบบตอกย้ำความสนใจ (Re-Marketing) โฆษณา สิทธิประโยชน์ การขาย ข้อเสนอพิเศษ การแจ้งเตือน จดหมายข่าว รายงานความคืบหน้า ประกาศ กิจกรรมส่งเสริมการขาย ข่าวสารและข้อมูลที่เกี่ยวกับผลิตภัณฑ์หรือบริการของบริษัท และพันธมิตรทางธุรกิจของบริษัทฯ
            </p>
            <p class="my-4">
                เก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลที่ละเอียดอ่อนของข้าพเจ้า เช่น ข้อมูลศาสนา ที่ปรากฎบนสำเนาบัตรประจำตัวประชาชน หรือเอกสารที่ทางราชการออกให้ <b>เพื่อวัตถุประสงค์ในการยืนยันตัวตนและระบุตัวตนของข้าพเจ้า</b>
            </p>
            <p class="my-4">
                ข้าพเจ้าขอรับรองและยืนยันว่า ข้าพเจ้าได้อ่านและทราบถึงรายละเอียดของนโยบายความเป็นส่วนตัวของบริษัทฯ ที่ปรากฎ ณ <a href="https://www2.zoetis.co.th/privacy-policy" target="_blank"> https://www2.zoetis.co.th/privacy-policy </a> ซึ่งอธิบายวิธีการที่บริษัทฯ เก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้า
            </p>
        </div>

        <div class="py-2 text-center mt-auto" wire:loading.remove>
            <x-button lg icon="chevron-left" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl" wire:click="termStepSubmit(1)" type="button" label="กลับ" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

    <div class="setup-content min-h-[70vh] flex flex-col {{ $currentStep != 1.5 ? 'hidden' : '' }}" id="step-1-5">
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl pb-2 font-bold"> ยืนยัน OTP </h3>
            <p class="text-center">
                เราได้ส่ง SMS ไปยังหมายเลข {{$phone}} 
            </p>
        </div>
        <div class="single-input-container flex gap-2 my-8">
        <input wire:model.defer="code" type="text" maxlength="6" inputmode="numeric"
            class="{{$status=='error'?'border-secondary-red ring-2 ring-secondary-red':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" />
        </div>
        <!-- <div class="single-input-container flex gap-2 my-8">
            <input wire:model="otp.0" type="text" maxlength="1" class="{{$status=='error'?'border-secondary-red ring-2 ring-secondary-red':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" />
            <input wire:model="otp.1" type="text" maxlength="1" class="{{$status=='error'?'border-secondary-red ring-2 ring-secondary-red':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" />
            <input wire:model="otp.2" type="text" maxlength="1" class="{{$status=='error'?'border-secondary-red ring-2 ring-secondary-red':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" />
            <input wire:model="otp.3" type="text" maxlength="1" class="{{$status=='error'?'border-secondary-red ring-2 ring-secondary-red':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" />
            <input wire:model="otp.4" type="text" maxlength="1" class="{{$status=='error'?'border-secondary-red ring-2 ring-secondary-red':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" />
            <input wire:model="otp.5" type="text" maxlength="1" class="{{$status=='error'?'border-secondary-red ring-2 ring-secondary-red':'border-gray-300'}} text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" />
        </div> -->
        @if ($status == 'error')
        <x-badge icon="exclamation" nagative label="Your OTP is not match, please try agein" />

        <x-button lg outline icon="chevron-left" primary class="py-2 rounded-2xl" wire:click="back(1)" type="button" label="Back" />
        @endif
        <!-- <input wire:model="code" type="text" class="border-gray-300 text-center focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"/> -->
        <!-- <x-button wire:click="verifyCode" type="button" label="verifyCode" /> -->

        <div class="py-2 text-center mt-auto" wire:loading.remove>
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
             wire:click="varifyOTP" type="button" label="ถัดไป" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

    <div class="setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 2 ? 'hidden' : '' }}" id="step-2">
        <div class="mt-8 pb-2">
            <h3 class="text-center text-xl pb-2 font-bold text-primary-blue"> กรุณากรอกข้อมูลสุนัข </h3>
            <p class="text-center">
                ที่ต้องการรับคำปรึกษาและเข้าร่วม<br>
                โปรแกรม Super TRIO<br>
            </p>
        </div>

        <div class="grid gap-2 pb-8">
            <x-input wire:model.defer="pet_name" label="ชื่อสุนัข" placeholder="ชื่อสุนัข" />
            <x-input wire:model.defer="pet_breed" label="ชื่อพันธุ์สุนัข" placeholder="ชื่อพันธุ์สุนัข" />

            <!-- <x-native-select label="ชื่อพันธุ์สุนัข" wire:model.lazy="pet_breed" placeholder="เลือกพันธุ์สุนัข" :options="['German Shepherd','Bulldog','Labrador Retriever','Golden Retriever','French Bulldog','Siberian Husky','Poodle','Alaskan Malamute','Chihuahua','Border Collie','Afghan Hound','Airedale Terrier']" /> -->


            เลือกช่วงน้ำหนักของสุนัข
            <div class="grid grid-cols-2 gap-2">
                <span class="my-2">
                    <x-radio id="weigth-1" value="1.25-2.5 กก." label="1.25-2.5 กก." wire:model.defer="pet_weight" />
                </span>
                <span class="my-2">
                    <x-radio id="weigth-2" value="2.6-5 กก." label="2.6-5 กก." wire:model.defer="pet_weight" />
                </span>
                <span class="my-2">
                    <x-radio id="weigth-3" value="5.1-10 กก." label="5.1-10 กก." wire:model.defer="pet_weight" />
                </span>
                <span class="my-2">
                    <x-radio id="weigth-4" value="10.1-20 กก." label="10.1-20 กก." wire:model.defer="pet_weight" />
                </span>
                <span class="my-2">
                    <x-radio id="weigth-5" value="20.1-40 กก." label="20.1-40 กก." wire:model.defer="pet_weight" />
                </span>
                <span class="my-2">
                    <x-radio id="weigth-6" value="40.1-60 กก." label="40.1-60 กก." wire:model.defer="pet_weight" />
                </span>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <x-native-select label="อายุ (ปี)" wire:model.defer="pet_age_year" placeholder="ระบุปี" :options="['0','1', '2', '3', '4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20']" />
                <x-native-select label="อายุ (เดือน)" wire:model.defer="pet_age_month" placeholder="ระบุเดือน" :options="['0','1', '2', '3', '4','5','6','7','8','9','10','11']" />
            </div>
        </div>



        <div class="py-2 text-center flex justify-center mt-auto" wire:loading.remove>
            <!-- <div></div> -->
            <!-- <x-button lg outline icon="chevron-left" primary
                wire:click="back(1)" type="button" label="Back" /> -->
            <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
             wire:click="secondStepSubmit" type="button" label="ถัดไป" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 3 ? 'hidden' : '' }} " id="step-3">
        <div class="mt-8 pb-2">
            <h3 class="text-center">เลือกคลินิก หรือโรงพยาบาลสัตว์ </h3>
            <p class="text-center">ที่ต้องการรับคำปรึกษาและ<br>
                    เข้าร่วมโปรแกรม Super TRIO</p>
        </div>

        <div class="mt-4" wire:init="loadAddr">
            
        @if ($vet_province!=null)
            <x-select
                label="จังหวัด"
                wire:model="selected_vet_province"
                placeholder="เลือกจังหวัด"
                :options="$vet_province"
                

                clearable=false
            />
            @endif
        </div>
        @if ($selected_vet_province!=null)
        <div class="mt-4">

            <x-native-select label="อำเภอ" placeholder="เลือกอำเภอ" 
            :options="$vet_city"  wire:model="selected_vet_city" /> 
        </div>
        @endif

        @if ($selected_vet_city!=null)
        <div class="mt-4">
            <x-native-select label="ตำบล" placeholder="เลือกตำบล" :options="$vet_area"  wire:model="selected_vet_area" />
        </div>
        @endif
        @if ($selected_vet_area!=null)
        <div class="mt-4">
            <x-input label="vetname" wire:model="vet_name"/>
        </div>
        @endif
        @if ($vet_name!=null)
        {{$vet_name}} {{$selected_vet_area}} {{$selected_vet_city}} {{$selected_vet_province}}
        @endif
        
        <!-- {{$vet_id}}
                <x-input label="search" wire:model.debounce.1000ms="selected_vet_text" /> -->

        <!-- <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
        <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button> -->



        <div class="py-2 text-center flex justify-center mt-auto" wire:loading.remove>
            <!-- <div></div> -->
            <!-- <x-button lg outline icon="chevron-left" primary
                wire:click="back(1)" type="button" label="Back" /> -->
            <x-button wire:loading.attr="disabled"  lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
             wire:click="thirdStepSubmit" type="button" label="ถัดไป" />
        </div>
        <div class="py-2 text-center flex justify-center mt-auto" wire:loading>
            กำลังดำเนินการ...
        </div>
    </div>

    <div class="row setup-content  min-h-[70vh] flex flex-col {{ $currentStep != 4 ? 'hidden' : '' }}" id="step-4">
        <div class="mt-8 pb-2">    
        <h3 class="text-center text-xl my-8 p-4 font-bold text-white bg-primary-blue"> การลงทะเบียนเสร็จสมบูรณ์ </h3>
        <p class="text-center">
            ท่านได้รับสิทธิ์ รับคำปรึกษา <br>
            และเข้าร่วมโปรแกรม Super TRIO<br>
            โปรแกรมปกป้องสุนัขจากปรสิตร้ายที่อันตรายถึงชีวิต<br>

        </p>
        </div>
        <img class="my-4 px-8" src="{{url('/app-banner.png')}}" />
        <p class="text-center">
            สามารถ พาน้อง {{$pet_name}}<br>
            ขนาด {{$pet_weight}}<br>
            ไปรับคำปรึกษา<br>
            และเข้าร่วมโปรแกรม Super TRIO<br>
            ได้ที่ {{$vet_id?App\Models\Vet::find($vet_id)->vet_name:'-'}} ครับ<br>
        </p>
        <p class="text-center text-xs text-secondary-red">
            กรุณากดรับสิทธิ์ขณะที่ท่านอยู่ที่คลินิกตามที่ลงทะเบียน<br>
            เพื่อโชว์หลักฐานการลงทะเบียนให้คลินิกรับทราบ<br>
            (รหัสมีอายุ 15 นาที)
        </p>

        <div class="py-2 text-center flex justify-center mt-auto">
            <!-- <div></div> -->
            <!-- <x-button lg outline icon="chevron-left" primary
                wire:click="back(1)" type="button" label="Back" /> -->

            {{-- <x-button lg right-icon="chevron-right" primary class="bg-gradient-to-br from-gradient-start to-gradient-end rounded-2xl"
             wire:click="activateClient()" type="button" label="กดเพื่อแสดงหลักฐาน" /> --}}

        </div>

    </div>
</div>
