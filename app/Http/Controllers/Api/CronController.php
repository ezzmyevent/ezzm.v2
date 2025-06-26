<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Session, Config, DB, Storage;
use App\Mail\OnlineRegisterEmail;
use App\Mail\ReminderEmail;
use App\Models\User;
use App\Http\Controllers\WhatsappmsgController;
class CronController extends Controller{
    public function __construct(){
        $this->now = Carbon::now();
    }



    public function sendemail(){
        $users = DB::table('users')->where('email_send', 0)->where('status',1)->limit(1)->get()->toArray();
        foreach ($users as $val) {
                $array2 = array(
                    "custom_sender_name" =>"LKQI 2025",
                    "project_secret_key" => '34f530bb-203e-46ff-90db-889df05a6b2c',
                    "type" => "PROMOTIONAL",
                    "to" => array($val->email),
                    "cc" => array(),
                    "bcc" => array(),
                    "subject" => "Ezzmyevent 2025 : Your exclusive QR code for registration",
                    "attachments" => array(array('content' => base64_encode(file_get_contents($val->eticket_path)), "filename" => 'm-badge.png', 'type' => 'image/png', 'disposition' => 'attachment', 'encoding' => 'base64')),
                    "body" => view('emails.register-template', ['name' => $val->name])->render(),
                );

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://dev-notifications.ezzmyeventmail.co/V2/email-notification/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>  json_encode($array2),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic UGFyYWxsZWxfS2V5X2Zvc3RlcnNrbmFsbmFhbWUgU3RlZWw=',
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $data = json_decode($response, true);
                $transactionId = $data['body']['transaction_id'];
                if($transactionId)
                {
                    DB::table('users')->where('id', $val->id)->update(['email_send' => 1]);
                }
                curl_close($curl);
            }
        echo "Done";
    }
    private function generateOTP(){
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }
    



    public function sendotp(){
        $users = DB::table('users')
        ->where('otp_status', 0)->whereNotNull('otp')->where('otp', '!=', '')->limit(1)->get()->toArray();
        foreach ($users as $val) {
            $user = User::where('email', $val->email)->first();
            if (!empty($user))
            {
               
                $array2 = array(
                    "custom_sender_name" =>"Your OTP for Verification",
                    "project_secret_key" => '34f530bb-203e-46ff-90db-889df05a6b2c',
                    "type" => "PROMOTIONAL",
                    "to" => array($val->email),
                    "cc" => array(),
                    "bcc" => array(),
                    "subject" => "Thank you for registering for Ezzmyevent 2025.",
                    "body" => view('emails.copy-send-otp', ['name' => $val->name,'otp'=>$user->otp])->render(),
                );

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    //CURLOPT_URL => 'https://notifications.ezzmyeventmail.co:5000/email/notification/request',
                    CURLOPT_URL => 'https://dev-notifications.ezzmyeventmail.co/V2/email-notification/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>  json_encode($array2),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic UGFyYWxsZWxfS2V5X2Zvc3RlcnNrbmFsbmFhbWUgU3RlZWw=',
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $data = json_decode($response, true);
                $transactionId = $data['body']['transaction_id'];
                if($transactionId)
                {
                    DB::table('users')->where('id', $val->id)->update(['otp_status' => 1]);
                }
                curl_close($curl);

            }
            }
        echo "Done";
    }

    public function sendwhatsappremidnerfirst()
    {
        $users = DB::table('users')->where('send_whatsapp', 0)->where('status', 1)->where('phone', '!=', '')->limit(2)->get()->toArray();
        if (!empty($users))
        {
            foreach ($users as $val)
            {
                if (!empty($val->phone))
                {
                    $countryCode = isset($val->country_code)?$val->country_code:'+91';
                    $phonenumber = $val->phone;
                    $mobilenumber = $countryCode.$phonenumber;
                    $phonenumber = str_replace('+', '', $mobilenumber);
                    $unique_code = $val->unique_code;

                    $name = ucwords($val->name);
                    $eticket_path = asset($val->eticket_path) . "?v=" . time();

                    $templatename = "lkqi";

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://staging-notifications.ezzmyeventmail.co:5020/v1/whatsapp/send-message',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>'{
                        "project_secret_key": "22e32017-cc91-49a8-a216-a518f5e9af87",
                        "fullPhoneNumber": "'.$phonenumber.'",
                        "type":"Template",
                        "templateName": "'.$templatename.'",
                        "templateLanguage": "en",
                        "header":[
                        {
                                "type": "image",
                                "value": "'.$eticket_path.'"
                            }
                        ],
                        "body":[
                                {
                                "type": "text",
                                "value": "'.$name.'"
                                }
                        ]
                          }',
                        CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic UGFyYWxsZWxfS2V5X2Zvc3RlcnNrbmFsbmFhbWUgU3RlZWw=',
                        'Content-Type: application/json'
                        ),
                    ));
                    $response = curl_exec($curl);
                    
                    // dd($response);
                    echo $response."<br>";

                    curl_close($curl);
                    DB::table('users')->where('id', $val->id)->update(['send_whatsapp' => 1]);
                }
            }
            exit("success.");
        }
    }

    public function reminder_sendemail(){
        $users = DB::table('users')->where('rem_email_send',0)->where('email','!=','')->where('status',1)->limit(10)->get()->toArray();
        // $users = DB::table('users')->where('email','dhurva@distinctcomm.co.in')->where('rem_email_send',0)->where('email','!=','')->where('status',1)->limit(1)->get()->toArray();
       
        foreach ($users as $val) {
                $array2 = array(
                    "custom_sender_name" =>"LKQI 2025",
                    "project_secret_key" => '34f530bb-203e-46ff-90db-889df05a6b2c',
                    "type" => "PROMOTIONAL",
                    "to" => array($val->email),
                    "cc" => array(),
                    "bcc" => array(),
                    "subject" => "Ezzmyevent 2025 : Your exclusive QR code for registration",
                    "attachments" => array(array('content' => base64_encode(file_get_contents($val->eticket_path)), "filename" => 'm-badge.png', 'type' => 'image/png', 'disposition' => 'attachment', 'encoding' => 'base64')),
                    "body" => view('emails.reminder-template', ['name' => $val->name])->render(),
                );

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://dev-notifications.ezzmyeventmail.co/V2/email-notification/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>  json_encode($array2),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic UGFyYWxsZWxfS2V5X2Zvc3RlcnNrbmFsbmFhbWUgU3RlZWw=',
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                $data = json_decode($response, true);
                $transactionId = $data['body']['transaction_id'];
                if($transactionId)
                {
                    DB::table('users')->where('id', $val->id)->update(['rem_email_send' => 1]);
                }
                curl_close($curl);
            }
        echo "Done";
    }


    public function send_reminder_whatsapp(){
        $users = DB::table('users')->where('sendInvitation_whatsapp',0)->where('phone','!=','')->where('status',1)->limit(10)->get()->toArray();
        // echo "<pre>";print_r($users);die;
       if (!empty($users))
        {
            foreach ($users as $val)
            {
                if (!empty($val->phone))
                {
                    $countryCode = isset($val->country_code)?$val->country_code:'+91';
                    $phonenumber = $val->phone;
                    $mobilenumber = $countryCode.$phonenumber;
                    $phonenumber = str_replace('+', '', $mobilenumber);
                    $unique_code = $val->unique_code;

                    $name = ucwords($val->name);
                    $eticket_path = asset($val->eticket_path) . "?v=" . time();

                    $templatename = "lkq_reminder_msg_new_new";

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://staging-notifications.ezzmyeventmail.co:5020/v1/whatsapp/send-message',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>'{
                        "project_secret_key": "aaf911e1-86da-4339-9642-1ce58db91e9e",
                        "fullPhoneNumber": "'.$phonenumber.'",
                        "type":"Template",
                        "templateName": "'.$templatename.'",
                        "templateLanguage": "en",
                        "header":[
                        {
                                "type": "image",
                                "value": "'.$eticket_path.'"
                            }
                        ],
                        "body":[
                                {
                                "type": "text",
                                "value": "'.$name.'"
                                }
                        ]
                          }',
                        CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic UGFyYWxsZWxfS2V5X2Zvc3RlcnNrbmFsbmFhbWUgU3RlZWw=',
                        'Content-Type: application/json'
                        ),
                    ));
                    $response = curl_exec($curl);
                    
                    // dd($response);
                    echo $response."<br>";

                    curl_close($curl);
                    DB::table('users')->where('id', $val->id)->update(['sendInvitation_whatsapp' => 1]);
                }
            }
            exit("success.");
        }
    }



    public function whatsapp_one(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        $users = DB::table('users')->where('metro',0)->where('status', 1)->where('phone', '!=', '')->limit(50)->get()->toArray();
        if (!empty($users))
        {
            foreach ($users as $val)
            {
                if (!empty($val->phone)) {
                    $countryCode = isset($val->country_code) ? $val->country_code : '+91';
                    $phonenumber = $val->phone;
                    $mobilenumber = $countryCode . $phonenumber;
                    $phonenumber = str_replace('+', '', $mobilenumber); // Remove the '+' for fullPhoneNumber
                    $unique_code = $val->unique_code;
                
                    $name = ucwords($val->name);
                    $eticket_path = asset('public/Metro_Shuttles.jpg');
                    $templatename = "lkq_metro";

                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://staging-notifications.ezzmyeventmail.co:5020/v1/whatsapp/send-message',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => json_encode([
                            "project_secret_key" => "4a0a68ad-133c-4431-b7d8-b0625c95199a",
                            "fullPhoneNumber" => $phonenumber,
                            "type" => "Template",
                            "templateName" => $templatename,
                            "templateLanguage" => "en",
                            "header" => [
                                [
                                    "type" => "image",
                                    "value" => $eticket_path
                                ]
                            ],
                            "body" => [
                                [
                                    "type" => "text",
                                    "value" => $name
                                ]
                            ]
                        ]),
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: Basic UGFyYWxsZWxfS2V5X2Zvc3RlcnNrbmFsbmFhbWUgU3RlZWw=',
                            'Content-Type: application/json'
                        ),
                    ));
                    $response = curl_exec($curl);
                
                    if (curl_errno($curl)) {
                        echo 'Curl error: ' . curl_error($curl);
                    } else {
                        echo $response . "<br>";
                    }
                
                    curl_close($curl);
                    DB::table('users')->where('id', $val->id)->update(['metro' => 1]);
                }
                
            }
            exit("success.");
        }
    }

    public function whatsapp_two()
    {
        $users = DB::table('users')->where('map_location',0)->where('status', 1)->where('phone', '!=', '')->limit(50)->get()->toArray();
        if (!empty($users))
        {
            foreach ($users as $val)
            {
                if (!empty($val->phone))
                {
                    $countryCode = isset($val->country_code)?$val->country_code:'+91';
                    $phonenumber = $val->phone;
                    $mobilenumber = $countryCode.$phonenumber;
                    $phonenumber = str_replace('+', '', $mobilenumber);
                    $unique_code = $val->unique_code;

                    $name = ucwords($val->name);
                    $eticket_path = asset('public/Venue_Pop_up_map.jpg');
                    $templatename = "lkq_map_location";

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://staging-notifications.ezzmyeventmail.co:5020/v1/whatsapp/send-message',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>'{
                        "project_secret_key": "d5720cf6-8495-424d-8600-b89c01f66d6e",
                        "fullPhoneNumber": "'.$phonenumber.'",
                        "type":"Template",
                        "templateName": "'.$templatename.'",
                        "templateLanguage": "en",
                        "header":[
                        {
                                "type": "image",
                                "value": "'.$eticket_path.'"
                            }
                        ],
                        "body":[
                                {
                                "type": "text",
                                "value": "'.$name.'"
                                }
                        ]
                          }',
                        CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic UGFyYWxsZWxfS2V5X2Zvc3RlcnNrbmFsbmFhbWUgU3RlZWw=',
                        'Content-Type: application/json'
                        ),
                    ));
                    $response = curl_exec($curl);
                    
                    // dd($response);
                    echo $response."<br>";

                    curl_close($curl);
                    DB::table('users')->where('id', $val->id)->update(['map_location' => 1]);
                }
            }
            exit("success.");
        }
    }


    public function whatsapp_three()
    {
        $users = DB::table('users')->where('food_menu',0)->where('status', 1)->where('phone', '!=', '')->limit(50)->get()->toArray();
        if (!empty($users))
        {
            foreach ($users as $val)
            {
                if (!empty($val->phone))
                {
                    $countryCode = isset($val->country_code)?$val->country_code:'+91';
                    $phonenumber = $val->phone;
                    $mobilenumber = $countryCode.$phonenumber;
                    $phonenumber = str_replace('+', '', $mobilenumber);
                    $unique_code = $val->unique_code;

                    $name = ucwords($val->name);
                    $eticket_path =  asset('public/Sangamamenu.pdf');
                    // echo "<pre>";print_r($eticket_path);die;

                    $templatename = "lkq_food_menu";

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://staging-notifications.ezzmyeventmail.co:5020/v1/whatsapp/send-message',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>'{
                        "project_secret_key": "b4fd23b8-887c-4644-a783-70aa0e2039da",
                        "fullPhoneNumber": "'.$phonenumber.'",
                        "type":"Template",
                        "templateName": "'.$templatename.'",
                        "templateLanguage": "en",
                        "header":[
                        {
                                "type": "document",
                                "value": "'.$eticket_path.'",
                                "document": {
                                        "link": "'.$eticket_path.'",
                                        "filename": "Sangama-menu.pdf"
                                    }
                            }
                        ],
                        "body":[
                                {
                                "type": "text",
                                "value": "'.$name.'"
                                }
                        ]
                          }',
                        CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic UGFyYWxsZWxfS2V5X2Zvc3RlcnNrbmFsbmFhbWUgU3RlZWw=',
                        'Content-Type: application/json'
                        ),
                    ));
                    $response = curl_exec($curl);
                    
                    // dd($response);
                    echo $response."<br>";

                    curl_close($curl);
                    DB::table('users')->where('id', $val->id)->update(['food_menu' => 1]);
                }
            }
            exit("success.");
        }
    }


}