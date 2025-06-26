<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Validator,Log,DB;

// mail modal
use App\Models\Smtp;
use App\Services\EmailService;
use Illuminate\Validation\Rule;

//

use App\Models\Event;
use App\Models\User;
use App\Models\ShortCode;
use App\Models\MailTemplate;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\CustomShortCode;

class MailTemplateController extends Controller
{
    //
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function index(){
        $pagination = 'yes';
        $mailtemplates = MailTemplate::paginate(25);
        return view('admin.mail-template.index',compact('mailtemplates','pagination'));
    }

    public function create(){
        $tables = [
            'events' => Schema::getColumnListing('events'),
            'users' => Schema::getColumnListing('users'),
            'orders' => Schema::getColumnListing('orders'),
            'custom_short_codes' => Schema::getColumnListing('custom_short_codes'),
        ];

        $categorieslist = Ticket::select('category','slug')->where('status',1)->get();        
        return view('admin.mail-template.create',compact('tables','categorieslist'));
    }

    public function store(Request $request){

        $rules = [
            'title' => 'required|string|min:3',
            'subject' => 'required|string|min:3',
            'content' => 'required|string|min:3',
            'reminder_status' => [
                    'required',
                    'numeric',
                    'gt:0',
                    Rule::unique('mail_templates', 'reminder_status'),
            ],
            'status' => 'required|in:0,1'
        ];
        
        
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        try {

           $data = array(
            'title' => $request->title, 
            'subject' => $request->subject,
            'attachment' => $request->attachment,
            'content' => $request->content,
            'reminder_status' => $request->reminder_status,
            'user_category' => $request->user_category,
            'status' => $request->status
           );

           MailTemplate::create($data);
           return response()->json(['success' => 'Mail Template Created Successfully.'], 201);
        } catch (\Throwable $e) {
            //throw $th;
            Log::error('Error creating ticket: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e
            ]);
            return response()->json(['error' => 'There was an issue creating the ticket. Please try again later.'], 500);
        }

    }

    public function edit($id=''){
        if($id){
            $templateDetail = MailTemplate::find($id);
            if(is_null($templateDetail)){
                return redirect()->route('mail-template.index');
            }else{
                $tables = [
                    'events' => Schema::getColumnListing('events'),
                    'users' => Schema::getColumnListing('users'),
                    'orders' => Schema::getColumnListing('orders'),
                    'custom_short_codes' => Schema::getColumnListing('custom_short_codes'),
                ];
                $categorieslist = Ticket::select('category','slug')->where('status',1)->get();        
                return view('admin.mail-template.edit',compact('templateDetail','id','tables','categorieslist'));
            }
        }else{
           return redirect()->route('mail-template.index');
        }
    }

    public function update(Request $request){

        $rules = [
            'title' => 'required|string|min:3',
            'subject' => 'required|string|min:3',
            'content' => 'required|string|min:3',
            'reminder_status' => [
                'required',
                'numeric',
                'gt:0',
                Rule::unique('mail_templates', 'reminder_status')->ignore($request->updateid),
            ],
            'status' => 'required|in:0,1',
        ];
        
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()], 400);
        }
        try {

           $data = array(
            'title' => $request->title, 
            'subject' => $request->subject,
            'content' => $request->content,
            'attachment' => $request->attachment,
            'reminder_status' => $request->reminder_status,
            'user_category' => $request->user_category,
            'status' => $request->status
           );
           
           MailTemplate::where('id',$request->updateid)->update($data);
           return response()->json(['success' => 'Mail Template Update Successfully.'], 201);
        } catch (\Throwable $e) {
            //throw $th;
            Log::error('Error updating ticket: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e
            ]);
            return response()->json(['error' => 'There was an issue updating the ticket. Please try again later.'], 500);
        }
    }

    public function destroy($id){
        if($id){
            $templateDetail = MailTemplate::find($id);
            if(is_null($templateDetail)){
                return redirect()->route('mail-template.index');
            }else{
                $templateDetail->delete();
                return redirect()->route('mail-template.index');
            }
        }else{
           return redirect()->route('mail-template.index');
        }
    }

    // adding sortcode
    public function addshortcode(Request $request){
        $rules = [
            'title' => 'required|string|min:3', 
            'shortcode' => [
                'required',
                'string',
                'unique:short_codes,shortcode',
                'regex:/^##[a-zA-Z0-9_]+##$/'
            ],
            'attachwith' => 'required'
        ];
        
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()], 400);
        }
        try {
            $explodedData = explode('.',$request->attachwith);
            $data = [
                'title' => $request->title,
                'shortcode' => $request->shortcode,
                'table_name' => ($explodedData[0])?$explodedData[0]:'',
                'column_name' => ($explodedData[1])?$explodedData[1]:''
            ];
            ShortCode::create($data);
            return response()->json(['success' => 'Shortcode created successfully'], 201);
        } catch (\Throwable $e) {
            //throw $th;
            Log::error('Error creating shortcode: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e
            ]);
            return response()->json(['error' => 'There was an issue creating the shortcode. Please try again later.'], 500);
        }

    }

    public function shortcodelist(){
        $shortcodelist = ShortCode::all();
        if(!is_null($shortcodelist)){
            return response()->json(['success' => 'ShortCode Data Found' , 'list' => $shortcodelist], 201);
        }else{
            return response()->json(['error' => 'There was an issue creating the shortcode. Please try again later.'], 400);
        }
    }

    // send test mail for template check
    public function sendMailForCheckTemplate(Request $request)
    {

        $rules = [
            'templateid' => 'required|numeric',
            'to_emails' => 'required|email'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        $templateid = $request->templateid;
        $emailTemplate = MailTemplate::find($templateid);
        if (!is_null($emailTemplate)) {

            $to_emails = $request->to_emails;
            $toEmails = explode(',', $to_emails);
            $toEmails = array_filter(array_map('trim', $toEmails), function ($email) {
                return filter_var($email, FILTER_VALIDATE_EMAIL);
            });
            if (empty($toEmails)) {
                return response()->json(['error' => 'No valid email addresses provided'], 400);
            }

            $subject = $emailTemplate->subject;
            $body = $emailTemplate->content;

          //  return $toEmails;
            $response = $this->emailService->sendEmail($toEmails, $subject, $body);
            
            return response()->json([
                'status' => true,
                'success' => 'Emails sent successfully',
                'response' => json_decode($response, true)
            ], 200);
        } else {
            return response()->json(['error' => 'Template not found'], 400);
        }
    }
    
    // send test mail for template check
    public function sendMailToUser(Request $request)
    {

        $rules = [
            'templateid' => 'required|numeric',
            'to_emails' => 'required|email'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        $templateid = $request->templateid;
        $emailTemplate = MailTemplate::find($templateid);
        if (!is_null($emailTemplate)) {
            $toEmails = $request->to_emails;
            if (empty($toEmails)) {
                return response()->json(['error' => 'No valid email addresses provided'], 400);
            }
            $event_detail = Event::first();
            $userdetail = User::where('email',$toEmails)->first();
            if(!empty($userdetail)){               
                $data = [];
                $attachments = [];

                
                $data['users'] = $userdetail->toArray();
                if ($event_detail) {
                    $data['events'] = $event_detail->toArray();
                }   
                
                $orderdetail = Order::where('user_id',$userdetail->id)->first();
                if($orderdetail){
                    $data['orders'] = $orderdetail->toArray();
                }

                $customshortcodes = CustomShortCode::first();
                if($customshortcodes){
                    $data['customshortcodes'] = $customshortcodes->toArray();
                }

                //  for attachments
                if(!empty($emailTemplate->attachment)){
                    $attachmentsurls = $this->replaceShortcodesForAttachment($emailTemplate->attachment,$data);
                    $attachmentsurls = $this->removeShortcodes($attachmentsurls);
                    $urlArray = explode(',', $attachmentsurls);
                    if(sizeof($urlArray) > 0 && !empty($urlArray)){
                        foreach ($urlArray as $url) {
                            $url = trim($url);                
                            $fileContent = file_get_contents($url);
                            if ($fileContent === false) {
                                continue;
                            }
                            $base64Content = base64_encode($fileContent);
                            $fileExtension = pathinfo($url, PATHINFO_EXTENSION);
                            $fileType = $this->getMimeType($fileExtension);
                            $filename = basename($url);
                        
                            $attachments[] = [
                                'content' => $base64Content,
                                'filename' => $filename,
                                'type' => $fileType,
                                'disposition' => 'attachment',
                                'encoding' => 'base64'
                            ];
                        }
                    }                    
                }
                // end attachements

                $subject = $this->replaceShortcodes($emailTemplate->subject, $data);
                $body = $this->replaceShortcodes($emailTemplate->content, $data);

                $to = [$toEmails];
                $response = $this->emailService->sendEmail($to, $subject, $body, $attachments);
                return response()->json([
                    'status' => true,
                    'success' => 'Emails sent successfully',
                    'response' => json_decode($response, true)
                ], 200);
            }else{
                return response()->json(['error' => 'User not found'], 400);
            }
        } else {
            return response()->json(['error' => 'Template not found'], 400);
        }
    }    
    
    // send mail to all user via cron
    public function sendReminderToAllUser(Request $request)
    {
        // Fetch email template
        $emailTemplate = MailTemplate::where('active_to_cron', 1)->first();
        if (is_null($emailTemplate)) {
            return response()->json(['error' => 'Template not found'], 400);
        }
    
        $templateReminderStatus = ($emailTemplate->reminder_status)?$emailTemplate->reminder_status:'';
        $templatecategory = ($emailTemplate->user_category)?$emailTemplate->user_category:'all';
    
        // Fetch users who need the reminder
        if($templatecategory == 'all'){
            $userdetail = User::where('reminderstatus', '!=', $templateReminderStatus)
            ->whereNotNull('email')
            ->where('status', 1)
            ->limit(20)
            ->get();
        }else{
            $userdetail = User::where('reminderstatus', '!=', $templateReminderStatus)
            ->whereNotNull('email')
            ->where('category',$templatecategory)
            ->where('status', 1)
            ->limit(20)
            ->get(); 
        }

    
        if ($userdetail->isEmpty()) {
            return response()->json(['error' => 'Users not found'], 400);
        }

        $event_detail = Event::first();
        $data = [];
        if ($event_detail) {
            $data['events'] = $event_detail->toArray();
        }

        // add attachment
        $attachments = $this->prepareAttachments($emailTemplate, $data);
    
        // Send emails
        $response = [];
        foreach ($userdetail as $user) {

            $data['users'] = $user->toArray();
            $orderdetail = Order::where('user_id',$user->id)->first();
            if($orderdetail){
                $data['orders'] = $orderdetail->toArray();
            }    
            $customshortcodes = CustomShortCode::first();
            if($customshortcodes){
                $data['customshortcodes'] = $customshortcodes->toArray();
            }

            $subject = $this->replaceShortcodes($emailTemplate->subject, $data);
            $body = $this->replaceShortcodes($emailTemplate->content, $data);
    
            $to = [$user->email];
            try {
                $emailResponse = $this->emailService->sendEmail($to, $subject, $body, $attachments);
                $response['success'][] = json_decode($emailResponse, true);
                // update reminderstatus
                DB::table('users')->where('id', $user->id)->update(['reminderstatus' => $templateReminderStatus]);
            } catch (\Exception $e) {
                $response['error'][] = ['error' => 'Failed to send email to ' . $user->email, 'message' => $e->getMessage()];
            }
        }
    
        return response()->json([
            'status' => true,
            'success' => 'Emails sent successfully',
            'response' => $response,
        ], 200);
    }
    
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

    // active template to cron
    public function activetocron(Request $request){

        $rules = [
            'id' => 'required|numeric'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        $mailData = MailTemplate::find($request->id);
        if(!is_null($mailData)){
            $deactiveAllTemplate = MailTemplate::where('id','!=','')->update([
                'active_to_cron' => 0
            ]);

            $activeAllTemplate = MailTemplate::where('id',$request->id)->update([
                'active_to_cron' => 1
            ]);
            return response()->json(['success' => 'Template Activated To Cron'], 201);

        }else{
            return response()->json(['error' => 'Template not found'], 400);
        }

    }
    
}
