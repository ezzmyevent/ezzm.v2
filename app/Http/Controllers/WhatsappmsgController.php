<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\{Http, URL};

class WhatsappmsgController extends Controller
{


    public function confirmation_msg($countryCode, $phone, $name, $eticketPath, $userId)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            # CURLOPT_URL => 'https://api.interakt.ai/v1/public/message/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                        "countryCode": "'.$countryCode.'",
                        "phoneNumber": "'.$phone.'",
                        "callbackData": "lkq_confirmation_msg",
                        "type": "Template",
                        "template": {
                            "name": "lkq_confirmation_msg",
                            "languageCode": "en",
                            "headerValues": [
                                "'.$eticketPath.'"
                                ],

                            "bodyValues": [
                                "'.$name.'"
                            ]
                           }   
                    }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic SXpwMGxwUDVuUlhxMEZ3ZWlzTzJHTXFWbU9LVGE0M0tSUHVQQ2Z6MWxObzo=',
                'Content-Type: application/json',
                'Cookie: ApplicationGatewayAffinity=a8f6ae06c0b3046487ae2c0ab287e175; ApplicationGatewayAffinityCORS=a8f6ae06c0b3046487ae2c0ab287e175'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }

    public function reminder_msg($countryCode, $phone, $name, $eticketPath, $userId)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            # CURLOPT_URL => 'https://api.interakt.ai/v1/public/message/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                        "countryCode": "'.$countryCode.'",
                        "phoneNumber": "'.$phone.'",
                        "callbackData": "vector_reminder_17_oct_2023_update",
                        "type": "Template",
                        "template": {
                            "name": "vector_reminder_17_oct_2023_update",
                            "languageCode": "en",
                            "headerValues": [
                                 "'.$eticketPath.'"
                            ]
                           }   
                    }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic SXpwMGxwUDVuUlhxMEZ3ZWlzTzJHTXFWbU9LVGE0M0tSUHVQQ2Z6MWxObzo=',
                'Content-Type: application/json',
                'Cookie: ApplicationGatewayAffinity=a8f6ae06c0b3046487ae2c0ab287e175; ApplicationGatewayAffinityCORS=a8f6ae06c0b3046487ae2c0ab287e175'
            ),
        ));





       $response = curl_exec($curl);
      // print_r($response);die;
        curl_close($curl);
    }
}