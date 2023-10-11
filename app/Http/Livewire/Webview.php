<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Webview extends Component
{
    public $data=[];
    public $device;
    public $browser;
    public $app;
    public function mount(){
        
    }
    public function getBrowser() { 
        $u_agent = $_SERVER['HTTP_USER_AGENT']; 
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    } 

    // now try it
    public function render()
    {
        $ua=$this->getBrowser();
        $this->browser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
        
        $this->data['REQUEST_TIME'] = $_SERVER['REQUEST_TIME']??'-';
        $this->data['HTTP_X_REQUESTED_WITH'] = $_SERVER["HTTP_X_REQUESTED_WITH"]??'-';
        $this->data['HTTP_USER_AGENT'] = $_SERVER["HTTP_USER_AGENT"]??'-';
        $this->data['HTTP_SEC_CH_UA'] = $_SERVER["HTTP_SEC_CH_UA"]??'-';
        $this->data['HTTP_SEC_CH_UA_MOBILE'] = $_SERVER["HTTP_SEC_CH_UA_MOBILE"]??'-';
        $this->data['HTTP_SEC_CH_UA_PLATFORM'] = $_SERVER["HTTP_SEC_CH_UA_PLATFORM"]??'-';

        if( preg_match('/iPhone/i',$this->data['HTTP_USER_AGENT']) ){
            $this->device = 'iPhone';
        }else if( preg_match('/iPad/i',$this->data['HTTP_USER_AGENT']) ){
            $this->device = 'iPad';
        }else if( preg_match('/Android/i',$this->data['HTTP_USER_AGENT']) ){
            $this->device = 'Android';
        }else if( preg_match('/Mac/i',$this->data['HTTP_USER_AGENT']) ){
            $this->device = 'Mac';
        }
        
        return view('livewire.webview');
    }
}
