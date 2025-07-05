<?php 
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Smtp;
use App\Models\Event;
use App\Models\User;
use App\Models\ShortCode;
use App\Models\MailTemplate;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\CustomShortCode;
use Illuminate\Validation\Rule;
use Validator,Log,DB;

class EmailHelperService
{

    function prepareAttachments($emailTemplate, $data)
    {
        $attachments = [];
        if (!empty($emailTemplate->attachment)) {
            $attachmentsurls = $this->replaceShortcodesForAttachment($emailTemplate->attachment, $data);
            $attachmentsurls = $this->removeShortcodes($attachmentsurls);
            $urlArray = array_filter(explode(',', $attachmentsurls));
            foreach ($urlArray as $url) {
                $url = trim($url);
                if ($fileContent = @file_get_contents($url)) {
                    $base64Content = base64_encode($fileContent);
                    $fileExtension = pathinfo($url, PATHINFO_EXTENSION);
                    $fileType = $this->getMimeType($fileExtension);
                    $filename = basename($url);
    
                    $attachments[] = [
                        'content' => $base64Content,
                        'filename' => $filename,
                        'type' => $fileType,
                        'disposition' => 'attachment',
                        'encoding' => 'base64',
                    ];
                }
            }
        }
    
        return $attachments;
    }
       
    function replaceShortcodes($template, $data)
    {
        $shortcodes = ShortCode::all();
        $replacements = [];
        foreach ($shortcodes as $shortcode) {
            $tableName = $shortcode->table_name;
            $columnName = $shortcode->column_name;
            $shortcodeKey = $shortcode->shortcode;
            if (isset($data[$tableName])) {
                $record = $data[$tableName];
                if (isset($record[$columnName])) {
                    $value = $record[$columnName];
                    if (filter_var($value, FILTER_VALIDATE_URL) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $value)) {
                        $replacements[$shortcodeKey] = '<img src="' . $value . '" class="content-image" alt="Image" />';
                    } else {
                        $replacements[$shortcodeKey] = $value;
                    }                    
                } else {
                    $replacements[$shortcodeKey] = '';
                }
            } else {
                $replacements[$shortcodeKey] = '';
            }
        }
        foreach ($replacements as $shortcode => $value) {
            $template = str_replace($shortcode, $value, $template);
        }
        return $template;
    }

    function replaceShortcodesForAttachment($template, $data) {
        $shortcodes = ShortCode::all();
        $replacements = [];
        foreach ($shortcodes as $shortcode) {
            $tableName = $shortcode->table_name;
            $columnName = $shortcode->column_name;
            $shortcodeKey = $shortcode->shortcode;
            if (isset($data[$tableName])) {
                $record = $data[$tableName];
                if (isset($record[$columnName])) {
                    $value = $record[$columnName];
                    if (filter_var($value, FILTER_VALIDATE_URL)) {
                        $replacements[$shortcodeKey] = $value;
                    }
                }
            }
        }
        foreach ($replacements as $shortcode => $value) {
            $template = str_replace($shortcode, $value, $template);
        }
        return $template;
    }
   
    function removeShortcodes($string) {
        $pattern = '/##[^#]+##/';
        $result = preg_replace($pattern, '', $string);
        $result = trim($result, ", \t\n\r\0\x0B");
        return $result;
    }    

    function getMimeType($fileExtension) {
        $mimeTypes = [
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
            // Add other MIME types as needed
        ];  
        return isset($mimeTypes[$fileExtension]) ? $mimeTypes[$fileExtension] : 'application/octet-stream';
    }    
}