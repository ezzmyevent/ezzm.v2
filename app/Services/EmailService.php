<?php 
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Smtp;
class EmailService
{
    protected $apiUrl = 'https://notifications.ezzmyeventmail.co:5000/email/notification/request';
    protected $apiKey = 'EZZ-KY-2025';

    public function sendEmail($to, $subject, $body, $attachments = [], $type = 'PROMOTIONAL')
    {
        $smtp = Smtp::first();
        if (!is_null($smtp)) {
            $token = $smtp->token;
            if ($token) {
                $response = Http::withHeaders([
                    'ezz-api-key' => $this->apiKey,
                    'Content-Type' => 'application/json',
                ])->post($this->apiUrl, [
                    'sender_name'=>'All-In India Event',
                    'project_secret_key' => $token,
                    'type' => $type,
                    'to' => $to,
                    'cc' => [],
                    'bcc' => [],
                    'subject' => $subject,
                    'body' => $body,
                    'attachments' => $attachments,
                ]);
    
                $responseBody = $response->body();
                $responseArray = json_decode($responseBody, true);
    
                if (isset($responseArray['status']) && $responseArray['status'] === true) {
                    return $responseBody;
                } else {
                    $errorMessage = $responseArray['message'] ?? 'Unknown error occurred.';
                    return json_encode([
                        'status' => false,
                        'message' => $errorMessage,
                    ]);
                }
            } else {
                return json_encode(['error' => 'SMTP token not found.']);
            }
        } else {
            return json_encode(['error' => 'SMTP details not found.']);
        }
    }
    
}
