<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{EmailTemplate,Interfaces, Ticket};
use App\Http\Requests\EmailTemplateRequest;
use Session;
use Http;

class EmailTemplateController extends Controller
{
    public function index(){
        $view_title = 'Email Templates';
        $view_type = 'listing';

        $email_templates = EmailTemplate::paginate(10);
        return view('admin.email_templates.email_templates',compact(['view_title','view_type','email_templates']));
    }

    public function create(){
        $view_title = 'Add Email Template';
        $view_type = 'add';
        $interfaces = Ticket::select('name','category')->groupBy('category')->get();

        return view('admin.email_templates.email_templates',compact(['view_title','view_type','interfaces']));
    }

    public function store(EmailTemplateRequest $request){
        $validated_data = $request->validated();
        $email_template = EmailTemplate::create($validated_data);
        if($email_template){
            Session::flash('success','Email Template has been added successfully.');
            return response()->json(
                ['redirect_url'=>route('email-templates.edit',$email_template->id),'message'=>'Email template has been added successfully.'],200);
        }

        return response()->json(
            ['message'=>'Something went wrong.'],400);
    }

    public function edit($email_template_id){
        $view_type = 'edit';
        $view_title = 'Update Email Template';
        $interfaces = Ticket::select('name','category')->groupBy('category')->get();
        $email_template = EmailTemplate::find($email_template_id);

        return view('admin.email_templates.email_templates',compact(['view_title','view_type','interfaces','email_template']));
    }

    public function update(EmailTemplateRequest $request,$email_template_id){
        $validated_data = $request->validated();
        $email_template = EmailTemplate::find($email_template_id);
        if(!$email_template){
            return response()->json(['message'=>'Email template not found.'],404);
        }

        $is_updated = $email_template->update($validated_data);
        if($is_updated){
            return response()->json(
                ['redirect_url'=>route('email-templates.edit',$email_template->id),'message'=>'Email template has been updated successfully.'],200);
        }

        return response()->json(
            ['message'=>'Something went wrong.'],400);
    }

    public function start(Request $request){
        $email_template = EmailTemplate::find($request->email_template_id);
        if(!$email_template){
            return response()->json(['message'=>'Email template not found.'],404);
        }

        $is_client_smtp = config('app.is_client_smtp');
        $event_name = config('app.name');
        $project_token = config('app.project_token');
        $mail_vendor = config('app.mail_driver');
        $email_config = config('app.mail_config');
        $email_type = config('app.mail_type');
        $cc = [];
        $bcc = [];

        $register_project_body = [
            'token'=>$project_token,
            'name'=>$event_name,
            'is_client_smtp'=>$is_client_smtp,
            'vendor'=>$mail_vendor,
        ];
        

        if($is_client_smtp){
            $register_project_body['configuration'] = $email_config;
        }

        $register_project_response = Http::withHeaders([
            'ezz-api-key'=>'EZZ-KY-2025',
        ])->post('https://nodezz.vehubzz.livezz:5000/project/register',$register_project_body)->object();
        
        if($register_project_response->status){

            if(isset($register_project_response->body->project_secret_key)){
                $send_email_body = [
                    'project_secret_key'=>$register_project_response->body->project_secret_key,
                    'type'=>$email_type,
                    'to'=>['ezzmyevent@gmail..'],
                    'cc'=>$cc,
                    'bcc'=>$bcc,
                    'subject'=>$email_template->template_subject,
                    'body'=>$email_template->template_body
                ];

                $send_email_response = Http::withHeaders([
                    'ezz-api-key'=>'EZZ-KY-2025'
                ])->post('https://nodezz.vehubzz.livezz:5000/email/notification/request',$send_email_body)->object();
                dd($send_email_response);
            }
        }
    }


}