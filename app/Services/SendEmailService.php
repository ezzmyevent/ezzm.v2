<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SendEmailService {
    protected $is_client_smtp;
    protected $event_name;
    protected $project_token;
    protected $mail_vendor;
    protected $email_config;

    protected $base_url = 'https://node.vehubzz.livezz:5000';
    protected $api_key = 'EZZ-KY-2025';
    protected $client;

    public function __construct(){
        $this->is_client_smtp = config('app.is_client_smtp');
        $this->event_name = config('app.name');
        $this->project_token = config('app.project_token');
        $this->mail_vendor = config('app.mail_driver');
        $this->email_config = config('app.mail_config', []);

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
    public function sendEmail($to, $cc, $bcc, $subject, $body, $email_type = 'TRANSACTION'){
        $payload = [
            'to' => $to,
            'cc' => $cc,
            'bcc' => $bcc,
            'subject' => $subject,
            'body' => $body,
            'email_type' => $email_type,
        ];

        // Integrate with remote API when endpoint is finalized
        return $payload;
    }

    private function setHeaders($headers = []){
        $headers = array_merge($headers,['ezz-api-key'=>$this->api_key]);
        return Http::withHeaders($headers);
    }
}