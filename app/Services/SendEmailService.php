<?php 

namespace App\Services;

use Http;

class SendEmailService {

    $is_client_smtp = config('app.is_client_smtp');
    $event_name = config('app.name');
    $project_token = config('app.project_token');
    $mail_vendor = config('app.mail_driver');
    $email_config = config('app.mail_config');


    $base_url = 'https://node.vehubzz.livezz:5000';
    $api_key = 'EZZ-KY-2025';
    $client;

    public function __construct(){
        $this->client = $this->setHeaders();
    }

    public function registerProject(){
        $body = [
            'token'=>$this->project_token,
            'name'=>$this->event_name,
            'is_client_smtp'=>$this->is_client_smtp,
            'vendor'=>$this->mail_vendor,
        ];
        

        if($body){
            $body['configuration'] = $this->email_config;
        }

        $response = $this->client->post($this->base_url.'/project/register',$body);
        
        return $response->object();
    }

    /**
     * @param array $to
     * @param array $cc
     * @param array $bcc
     * @param string $subject
     * @param string $body
     * @param string $email_type
     */
    public function sendEmail($to,$cc,$bcc,$subject,$body,$email_type = 'TRANSACTION'){
        $body = [
            ''
        ]
    }

    private function setHeaders($headers = []){
        $headers = array_merge($headers,['ezz-api-key'=>$this->api_key]);
        return Http::withHeaders($headers);
    }
}