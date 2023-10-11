<?php

namespace App\Http\Livewire;

use App\Jobs\SendEmail;
use App\Models\ThailandAddr;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Vet;
use Illuminate\Support\Str;

use GuzzleHttp\Client as smsClient;

class ClientRegister extends Component
{
    

    public $readyToLoad = false;

    public $validate_test=true;
    public Client $client;
    public $vet,$vetall;
    public $vet_name;
    public $vet_province,$vet_city,$vet_area,$vet_id;
    public $selected_vet_province,$selected_vet_city,$selected_vet_area,$selected_vet_text;

    public $currentStep = 1, $status = 1;
    public $firstname, $lastname, $phone,$email,$consent,$client_id;
    public $pet_name,$pet_breed,$pet_weight,$pet_age_month,$pet_age_year;
    public $successMessage = '';
    public $error;
    public $otp=array() ,$code;
    public $token;
    public $refno;


    protected $messages = [
        'email.email' => 'กรุณากรอก อีเมล์ ที่ถูกต้อง',
        'phone.required' => 'จำเป็นต้องระบุ หมายเลขโทรศัพท์',
        'phone.unique' => 'หมายเลขโทรศัพท์ นี้ลงทะเบียนรับสิทธิ์แล้ว',
    ];

    public bool $blurModal = true;

    public function loadAddr()
    {
        $this->readyToLoad = true;
    }
    public function mount()
    {
        // $this->confirmation();
        $this->validate_test = env('TWILIO', false);
        // ->unique('vet_province')->pluck('vet_province')

    }
    
    public function updatedSelectedVetProvince($selected_vet_province){
        $this->vet_city=ThailandAddr::where('Province',$selected_vet_province)->distinct('District')->pluck('District');
        
        $this->selected_vet_city=null;
        $this->selected_vet_area=null;
        // dd($this->vet_city,$selected_vet_province);

        /* $this->vetall = Vet::all();
        $this->vet_city =$this->vetall->where('vet_province',$selected_vet_province)->unique('vet_city');
        $this->vet=$this->vetall->where('vet_province',$selected_vet_province);
        $this->selected_vet_city=null;
        $this->selected_vet_area=null; */
        // $this->selected_vet_text=null;
    }
    public function updatedSelectedVetCity($selected_vet_city){

        $this->vet_area=ThailandAddr::where('District',$selected_vet_city)->get()->unique('Tambon')->pluck('Tambon');
        /* $this->vet_area =$this->vetall->where('vet_city',$selected_vet_city)->unique('vet_area');
        $this->vet=$this->vetall->where('vet_city',$selected_vet_city); */
        // dd($selected_vet_city,$this->vet_area);
        $this->selected_vet_area=null;
        // $this->selected_vet_text=null;
    }
    public function updatedSelectedVetText($selected_vet_text){
        // if($this->selected_vet_text!=null){
            $this->vet=$this->vetall->where('vet_name',"%{$selected_vet_text}%");
        // }
    }

    public function render()
    {
        return view('livewire.client-register');
    }


    private $rule=[
        'firstname' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        // 'email' => ['email', 'max:255'],
        'phone' => ['required', 'numeric','digits:10','min:10','regex:/^([0-9\s\(\)]*)$/', 'unique:'.Client::class],
        'consent' => ['required','bool']
    ];
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function firstStepSubmit()
    {
        // $this->consent = $this->consent==1?true:false;
        $validatedData = $this->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            // 'email' => ['email', 'max:255'],
            'phone' => ['required', 'numeric','digits:10','min:10','regex:/^([0-9\s\(\)]*)$/', 'unique:'.Client::class],
            'consent' => ['required','bool']
        ]);

        // dd($this->email,$this->firstname.' '.$this->lastname);
        // $this->verifyCodeTH();
        
        if($this->validate_test){
            $this->sendCodeTH();
        }

        $this->currentStep = 1.5;
        
        if($this->status=='pending'){
        }
    }
    public function termStepSubmit(){
        $validatedData = $this->validate([
            'consent' => ['required','bool']
        ]);

        $this->currentStep = 1;
    }
    public function varifyOTP(){

        // $this->code = implode('',$this->otp);
        
        if($this->validate_test){
            $result = $this->verifyCodeTH($this->code);
            if($this->status=="approved" || $result){
                $this->currentStep = 2;
            }else{
                $this->status = 'error';
            }
        }else{
            $this->currentStep = 2;
        }

    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'pet_name' => 'required',
            'pet_breed' => 'required',
            'pet_weight' => 'required',
            'pet_age_month' => 'required',
            'pet_age_year' => 'required',
        ]);

        $this->vet = Vet::all();
        $this->vet_province=ThailandAddr::distinct('Province')->pluck('Province');
        // dd($this->vet_province);
        // $this->vet_province = Vet::orderBy('vet_province','asc')->distinct('vet_province')->pluck('vet_province');
        $this->currentStep = 3;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function thirdStepSubmit()
    {
        $addr = ThailandAddr::where('Tambon',$this->selected_vet_area)
                                ->where('District',$this->selected_vet_city)
                                ->where('Province',$this->selected_vet_province)->first();
        $vet = $this->vet_name.' '.$this->selected_vet_area.' '.$this->selected_vet_city.' '.$this->selected_vet_province;
        // dd($addr,$vet);
        $validatedData = $this->validate([
            'vet_name' => 'required'
        ]);

        $client = Client::updateOrCreate([
            'phone'=>$this->phone,
        ],[
            'email'=>$this->email??null,
            'name'=>$this->firstname.' '.$this->lastname,
            'phoneIsVerified'=>$this->code??"-",
            'pet_name'=>$this->pet_name,
            'pet_breed'=>$this->pet_breed,
            'pet_weight'=>$this->pet_weight,
            'pet_age_month'=>$this->pet_age_month,
            'pet_age_year'=>$this->pet_age_year,
            'vet_name'=>$vet,
            'addr_id'=>$addr->id,
            'active_status'=>'pending',
            'client_code'=>0,
        ]);
        $client->client_code = 'TRIO'.Str::padLeft($client->id, 5, '0');
        $client->save();
        // dd($client);
        
        if($this->validate_test){
            $this->confirmation();
        }
        $this->currentStep = 4;

        redirect( route('client.ticket',['phone'=>$this->phone]) );
        // $this->currentStep = 4;
    }
    public function confirmation(){

        $details = [
            'email' => $this->email??null,
            'phone' => $this->phone,
            'pet_name' => $this->pet_name,
            'vet_name' => Vet::find($this->vet_id)->vet_name,
            'name' => $this->firstname.' '.$this->lastname,
        ];
        // $details = [
        //     'email' => 'maggotgluon@gmail.com',
        //     'phone' => '0809166690',
        //     'pet_weight' => 'pet_weight',
        //     'vet_name' => 'vet_id',
        //     'name' => 'firstname'.' '.'lastname',
        // ];
        
        try {
            if($this->email){
                SendEmail::dispatch($details);
            }
    
            $body_sms = 'ยืนยันลงทะเบียนสำเร็จ ใช้สิทธิ์คลิก http://supertrio.app.mag.codes/client/login';
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://api-v2.thaibulksms.com/sms', [
                'form_params' => [
                  'msisdn' => '+66' . str_replace('-', '', $details['phone']) ,
                  'message' => $body_sms,
                  'sender' => 'SuperTRIO',
                  'force'=>'corporate',
                  'shorten_url' => 'true'
                ],
                'headers' => [
                  'accept' => 'application/json',
                  'authorization' => getenv('BULKSMS_AUTH'),
                  'content-type' => 'application/x-www-form-urlencoded',
                ],
              ]);

            // $accountSid = getenv("TWILIO_SID");
            // $authToken = getenv("TWILIO_AUTH_TOKEN");
            // $twilioNumber = getenv("TWILIO_FROM");
            // // dd($accountSid,$authToken);
            // $twilio = resolve('TwilioClient');
            // // $client = new Client($accountSid, $authToken);
            
            // $twilio->messages->create(
            //     '+66' . str_replace('-', '', $details['phone']) , [
            //     'from' => $twilioNumber,
            //     'body' => $body_sms
            // ]);
 
            // return back()
            // ->with('success','Sms has been successfully sent.');
 
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()
            ->with('error', $e->getMessage());
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function activateClient()
    {
        redirect( route('client.ticket',['phone'=>$this->phone]) );

        // $this->currentStep = 1;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearForm()
    {
        $this->firstname="";
        $this->lastname="";
        $this->email="";
        $this->phone="";
        $this->email="";
        $this->pet_name="";
        $this->pet_breed="";
        $this->pet_weight="";
        $this->pet_age_month="";
        $this->pet_age_year="";
        $this->vet_id="";
        $this->status = 1;
    }

    public function sendCode()
    {
        $twilio = resolve('TwilioClient');
        
        $verification = $twilio
            ->verify
            ->v2
            ->services(getenv('TWILIO_VERIFY_SID'))
            ->verifications
            ->create('+66' . str_replace('-', '', $this->phone), "sms");

        $this->status = $verification->status;
    }

    public function verifyCode()
    {
        $twilio = resolve('TwilioClient');
        
        try {
            $verification_check = $twilio
                ->verify
                ->v2
                ->services(getenv('TWILIO_VERIFY_SID'))
                ->verificationChecks
                ->create([
                    "code" => $this->code, // code
                    "to" => '+66' . str_replace('-', '', $this->phone)
                    ]);

        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;

        }
        if ($verification_check->valid == false) {
            $this->error = 'That code is invalid, please try again.';
        }else{
            $this->error = '';
            $this->status = $verification_check->status;
        }
        return $verification_check->valid;


    }

    public function sendCodeTH(){
        
        $client = new smsClient;

        try {
        $response = $client->request('POST', 'https://otp.thaibulksms.com/v2/otp/request', [
            'form_params' => [
              'key' => getenv('BULKSMS_KEY'),
              'secret' => getenv('BULKSMS_SECRET'),
              'msisdn' => '+66' . str_replace('-', '', $this->phone)
            ],
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/x-www-form-urlencoded',
            ],
        ]);
        // dd(json_decode($response->getBody()->getContents()));
        $this->token = json_decode($response->getBody()->getContents())->token;
        // $this->refno = json_decode($response->getBody()->getContents())->refno;
        // dd($response,$response->getBody(),$this->token );
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
          
    }
    public function verifyCodeTH(){
        // dd($this->status);
        $client = new smsClient;

        try {
            $response = $client->request('POST', 'https://otp.thaibulksms.com/v2/otp/verify', [
            'form_params' => [
                'key' => getenv('BULKSMS_KEY'),
                'secret' => getenv('BULKSMS_SECRET'),
                'token' => $this->token,
                'pin' => $this->code
            ],
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            ]);
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }

        // dd(json_decode($response->getBody()->getContents()) , $response, $response,$this->status );

        if (json_decode($response->getBody()->getContents())->status != 'success') {
            $this->error = 'That code is invalid, please try again.';
        }else{
            $this->error = '';
            $this->status = 'approved';
        }
        return $this->status == 'approved';

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function openConsent()
    {
        $this->consent = 1;
        $this->currentStep =1.25;
    }

}
