<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Interfaces;
use App\Models\Invitees;
use App\Models\InterfaceUserRegistrations;
use App\Models\UserInterface;
use Illuminate\Http\Request;
use DB,Storage;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteeEmail;
use App\Mail\InterfacrUserRegEmail;
use App\Mail\ImportInterfacrUserEmail;


class InterfacesController extends Controller
{
    public function __construct()
    {
        $this->now = Carbon::now();

    }
    
    public function index(Request $request, $interface_id)
    {
        $country = DB::table('countries')->get();

        $interface_data = Interfaces::where('id', $interface_id)->first();
        if( !empty( $request->input(['post_type'])) )
        {
            if($interface_data->type == 'invite'){
                
                $data = Invitees::select("*")
                ->when($request->input('search'), function ($query) use ($request) {
                    $query->where($request->field, 'LIKE', '%' . $request->search .'%');
                 })
                ->where('user_interface_id', $interface_id)
                ->where('status', 1)
                ->with('parent')
                ->paginate(50);
                
            } else {
                $data = InterfaceUserRegistrations::select("*")
                ->when($request->input('search'), function ($query) use ($request) {
                    $query->where($request->field, 'LIKE', '%' . $request->search .'%');
                 })
                ->where('user_interface_id', $interface_id)
                ->paginate(50);
            }
        } else {
            if($interface_data->type == 'invite'){
                $data = Invitees::where('user_interface_id', $interface_id)->where('status', 1)->with('parent')->paginate(50);
            } else {
                $data = InterfaceUserRegistrations::where('user_interface_id', $interface_id)->paginate(50);
            }
        }
        
        $title = $interface_data->name;
        return view('admin.interfaces.index', compact('title'))->with('interface_data', $interface_data)->with('data', $data)->with('country', $country);
    }

    public function inviteuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
            'email' => 'required|email|unique:invitees',
            'qty' => 'required',
        ],[
            'name.required' => 'Name is required.',
            'phone.required' => 'Phone number is required.',
            'phone.min' => 'Please enter valid phone number(Min=10).',
            'phone.max' => 'Please enter valid phone number(Max=10).',
            'email.required' => 'Email is required.',
            'qty.required' => 'Quantity is required.',
        ]);

        if ($validator->passes()) {
            $userId = Auth::guard('admin')->id();
            $invitees = new Invitees();
            $access_token = $invitees->access_token();
            
            $data = [
                'user_id' => $userId,
                'user_interface_id' => $request->user_interface_id,
                'interface_category' => $request->interface_category,
                'qty' => $request->qty,
                'remaining_qty' => $request->qty,
                'name' => $request->name,
                'email' => $request->email,
                'countryCode' => $request->country_code,
                'phone' => $request->phone,
                'status' => 1,
                'access_token' => $access_token,
                'created_at' => $this->now,
                'updated_at' => $this->now
            ];
            $result = Invitees::create($data);
            
            if(!empty($result)) {
                
                $body = [
                    'id' => $result->id,
                    'invited_by' => 'India Design 2022', 
                    'name' => $result->name,
                    'email' => $result->email,
                    'mobile' => $result->mobile,
                    'access_token' => $result->access_token,
                    'qty' => $result->qty
                ];
                
                Mail::to($result->email)->send(new InviteeEmail($body));
    
                Invitees::where('id', $request->user_id)->update(['remaining_qty' => $request->remaining_qty]);
                
            }

            return response()->json(['type'=>'Success', 'message'=> 'Invitation sent successfully.']);
        } else {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    public function editinviteuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'qty' => 'required',
        ],[
            'name.required' => 'Name is required.',
            'qty.required' => 'Quantity is required.',
        ]);

        if ($validator->passes()) {
            $invitees = new Invitees();
            
            $data = [
                'qty' => $request->qty,
                'name' => $request->name,
                'updated_at' => $this->now
            ];
            $result = Invitees::where('id', $request->invitee_id)->update($data);
            
            return response()->json(['type'=>'Success', 'message'=> 'Invitation updated successfully.']);
        } else {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    public function userList($invitee_id = Null)
    {
        $invitee_ids = Invitees::where('id', $invitee_id)->first();
        $all_invitee_ids = [];
        if($invitee_ids->parent_id == 0) {
            $all_invitee_ids[] = $invitee_ids->id;
            $all_invitees = $invitee_ids->allChildren;
            foreach($all_invitees as $value) {
                $all_invitee_ids[] = $value->id;
            }

            $user_data = InterfaceUserRegistrations::whereIn('invitee_id', $all_invitee_ids)->with('invitedBy')->paginate(50);
            
        } else {
            $all_invitee_ids[] = $invitee_ids->id;

            $user_data = InterfaceUserRegistrations::whereIn('invitee_id', $all_invitee_ids)->with('invitedBy')->paginate(50);
        }

        $title = 'Invitee User List';

        return view('admin.interfaces.userlist', compact('title'))->with('user_data', $user_data);
    }

    public function emailInvitee(Request $request)
    {
        $interface_user = InterfaceUserRegistrations::where('id', $request->id)->with('invitedBy')->first();
        
        $body = [
            'id' => $interface_user->id,
            'invited_by' => $interface_user->invitedBy['name'], 
            'name' => $interface_user->name,
            'email' => $interface_user->email,
            'festival_dates' => $interface_user->festival_dates,
            'unique_code' => $interface_user->unique_code,
            'qrcode_path' => $interface_user->qrcode_path,
        ];
        
        Mail::to($interface_user->email)->send(new InterfacrUserRegEmail($body));
        $this->registration_confirm_whatsapp($interface_user->name,$interface_user->phone,$interface_user->eticket_path);

        $data = array('type' => 'Success', 'message' => 'Email Resend Successfully.');       
        echo json_encode($data);
        exit();
    }

    public function registration_confirm_whatsapp($name,$mobile,$eticketpath)
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
            "countryCode": "+91",
            "phoneNumber": "'.$mobile.'",
            "callbackData": "some text here",
            "type": "Template",
            "template": {
                "name": "complimentry_template_confimation",
                "languageCode": "en",
                "headerValues": [
                    "'.$eticketpath.'"
                ],
                "bodyValues": [
                    "'.$name.'"
                ]
            }
        }',
            CURLOPT_HTTPHEADER => array(
            'Authorization: Basic N2t6c29fZ1FsTk1haUtwOTQ4SGQzVTdfT3dOX1g3aHYwODJQYUJQYjhIZzo=',
            'Content-Type: application/json',
            'Cookie: ApplicationGatewayAffinity=a8f6ae06c0b3046487ae2c0ab287e175; ApplicationGatewayAffinityCORS=a8f6ae06c0b3046487ae2c0ab287e175'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
                    
    }

    public function addinterfaceuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
            'email' => 'required|email|unique:invitees',
            'gender' => 'required',
            'state' => 'required',
            'city' => 'required',
            'company' => 'required',
        ],[
            'name.required' => 'Name is required.',
            'phone.required' => 'Phone number is required.',
            'phone.min' => 'Please enter valid phone number(Min=10).',
            'phone.max' => 'Please enter valid phone number(Max=10).',
            'email.required' => 'Email is required.',
            'gender.required' => 'Gender is required.',
            'state.required' => 'State is required.',
            'city.required' => 'City is required.',
            'company.required' => 'Company is required.',
        ]);

        if ($validator->passes()) {
            $userId = Auth::guard('admin')->id();
            $interface_user = new InterfaceUserRegistrations();
            //$unique_code = 'ID22I'.$interface_user->unique_code();
            $data = [
                'user_id' => $userId,
                'user_interface_id' => $request->user_interface_id,
                'category' => $request->interface_category,
                'name' => $request->name,
                'email' => $request->email,
                'countryCode' => '+91',
                'phone' => $request->phone,
                'gender' => $request->gender,
                'state' => $request->state,
                'city' => $request->city,
                'company' => $request->company,
                'festival_dates' => $request->festival_dates,
                'status' => 1,
                'created_at' => $this->now,
                'updated_at' => $this->now
            ];
            $result = $interface_user->create($data);

            return response()->json(['type'=>'Success', 'message'=> 'User added successfully.']);
        } else {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    public function sampleUserExcel()
    {
        $filename = " samplecsv.csv";

        $headerRow = [
            'Name',
            'Email',
            'Phone',
            'Gender',
            'State',
            'City',
            'Company',
            'Unique Code'
        ];
        
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        fclose($csvFile);
    }

    public function uploadInterfaceUsercsv($interface_id)
    {   
        $interface_category = UserInterface::where('id', $interface_id)->first();
        $userId = Auth::guard('admin')->id();

        if(isset($_POST["submit"])) {
            if(!empty($_FILES['file']['name'])){
                $date = date('Y-m-d H:i:s');	
                
                $target_file = $_FILES["file"]["tmp_name"];
                $csvFile = fopen($target_file, 'r');
                $i = 0;
                while (($row = fgetcsv($csvFile)) !== FALSE) {
                    if($i > 0) {
                        $data_array = [
                            'user_id' => $userId,
                            'user_interface_id' => $interface_id,
                            'name' => $row[0],
                            'email' => $row[1],
                            'countryCode' => '+91',
                            'phone' => $row[2],
                            'gender' => $row[3],
                            'state' => $row[4],
                            'city' => $row[5],
                            'company' => $row[6],
                            'unique_code' => $row[7],
                            'category' => $interface_category->category,
                            'festival_dates' => '12,13,14,15'
                        ];

                        $result = InterfaceUserRegistrations::create($data_array);
                    }
                $i++;
                }
                
            }
        }
        return redirect()->route('interfaces',['interface_id'=>$interface_id]);

    }

    public function exportInviteeData($interface_id)
    {
        $result = Invitees::where('status', 1)->get();

        $filename = "Data Reports.csv";

        $headerRow = ['Name', 'Email', 'Phone Number', 'Alloted Quantity', 'Remaining Quantity', 'Created', 'Unique Link'];
        

        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);

        foreach($result as $data)
        {
            $unique_link = route('invitees').'/'.$data['access_token'];
            $arr = [
                $data['name'],
                $data['email'],
                $data['countryCode'].' '.$data['phone'],
                $data['qty'],
                $data['remaining_qty'],
                date('Y-m-d H:i:s', strtotime($data['created_at'])),
                $unique_link
            ];

            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }

        fclose($csvFile);
    }

    public function exportInterfaceData($interface_id)
    {
        $result = InterfaceUserRegistrations::where('user_interface_id', $interface_id)->get();

        $filename = "Data Reports.csv";

        $headerRow = ['Name', 'Email', 'Phone Number', 'Gender', 'State', 'City', 'Company', 'Unique Code', 'Festival Dates', 'Created'];
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);

        foreach($result as $data)
        {
            $arr = [
                $data['name'],
                $data['email'],
                $data['countryCode'].' '.$data['phone'],
                $data['gender'],
                $data['state'],
                $data['city'],
                $data['company'],
                $data['unique_code'],
                $data['festival_dates'],
                date('Y-m-d H:i:s', strtotime($data['created_at']))
            ];

            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }

        fclose($csvFile);
    }



    //import vip user with category and verify at same time

    public function sampleVIPUserExcel()
    {
        $filename = " vipsamplecsv.csv";

        $headerRow = [
            'Name',
            'Email',
            'Phone'
        ];
        
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        fclose($csvFile);
    }


    public function interface_users(Request $request, $id)
        {
            $title = 'Vip User';
            return view('admin.interfaces.interface_users', compact('title'))->with('id', $id);
        }


    public function import_interface_users(Request $request, $id)
    {   
        if(isset($_POST["submit"])) {
            if(!empty($_FILES['file']['name'])){
                $date = date('Y-m-d H:i:s');    
                $interface_category_name = UserInterface::where('id', $id)->first();
                $target_file = $_FILES["file"]["tmp_name"];
                $csvFile = fopen($target_file, 'r');
                $i = 0;
                while (($row = fgetcsv($csvFile)) !== FALSE) {
                    if($i > 0) {
                        $data_array = [
                            'user_id' => 1,
                            'user_interface_id' => $id,
                            'name' => $row[0],
                            'email' => $row[1],
                            'countryCode' => '+91',
                            'phone' => $row[2],
                            'category' => $interface_category_name->category,
                            'festival_dates' => '12,13,14,15'
                        ];

                        $result = InterfaceUserRegistrations::create($data_array);
                        $this->verify($result->id);
                    }
                $i++;
                }
                
            }
        }
        //return redirect()->route('interface_users',['id'=>$id])->with('success','VIP User Imported successfully.');

    }

 public function verify($user_id)
        {
            $users = InterfaceUserRegistrations::where(['id'=>$user_id]) 
            ->get();


           
            //dd($users->toArray());

            if(!empty($users->toArray()))  
            {
            foreach($users as $users)
                {
                    $userID = $users->id;
                    $email = $users->email;
                    $name = $users->name;
                    $mobile = $users->phone;
                    $category = $users->category;
                    
                    $unique_code = DB::table('interface_registration_unique_codes')->where('is_used', 0)->orderBy('id', 'DESC')->first();
                    // dd($unique_code);
                    DB::table('interface_registration_unique_codes')->where('id', $unique_code->id)->update(['is_used' => 1, 'modified' => Carbon::now()]);
                    $unique_code = $unique_code->unique_code;

                    //dd($unique_code);

                    $interface_category_name = UserInterface::where('category', $category)->first();
                    $qr_path=$this->generateQr($unique_code,$interface_category_name->shortcode);
    
                    $body = [
                        'id' => $userID,
                        'name' => $name,
                        'email' => $email,
                        'mobile' => $mobile,
                        'unique_code' => $unique_code,
                        'qrcode_path' => $qr_path,
                    ];
             
                   // dd($body);
                    Mail::to($email)->send(new ImportInterfacrUserEmail($body));

                    $new = imagecreatefrompng($qr_path);
                    $master = imagecreatefrompng('public/ID22.png');
                                        
                    imagealphablending($master, false);
                    imagecopymerge($master, $new, 150, 510, 0, 0, 150, 150, 100);
                    // imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct )
                    
                    $white = imagecolorallocate($master, 0, 0, 0);
                    $font =  realpath('public/arial.ttf');
                    imagettftext($master, 20, 0, 150, 690, $white, $font, $unique_code);
            
                   // header('Content-Type: image/png');
                    $masterImg= imagepng($master,'public/eticket/'.$unique_code.".png");

                  if($masterImg)
                  {
                    $upload_name= "indiadesign/eticket/".$unique_code.".png";
                    $eticketpath = Storage::disk('s3')->put($upload_name, file_get_contents('public/eticket/'.$unique_code.'.png'), 'public');
                    $eticketpath = Storage::disk('s3')->url($upload_name);
                    unlink('public/eticket/'.$unique_code.'.png');
              
                }
                  $this->interface_import_whatsapp($name,$mobile,$eticketpath);
                    
                   
                    if(Mail::failures() != 0)
                    {              
                    
                        InterfaceUserRegistrations::where('id', $userID)->update(['qrcode_path'=>$qr_path,'unique_code'=>$unique_code,'eticket_path'=>$eticketpath]);
                        
                      //  return redirect('/thanks');
                        echo "<p> Message Sent. </p>";
                    }
                    else
                    {                
                        echo "<p> Message Failed. </p>";
                    }
                }
               
            }  
            else{
               
              //  return redirect('/thanks');

            }     

            

        }

        public function generateQr($unique_code, $category)
        {

            $arr=array("$unique_code","$category");
            $document = QrCode::format('png')->margin(2)->size(150)->backgroundColor(255, 255, 255)->generate(json_encode($arr));
            $upload_name= "indiadesign/qrcodes/".$unique_code.".png";
            $document_path = Storage::disk('s3')->put($upload_name, $document, 'public');
            $document_path = Storage::disk('s3')->url($upload_name);
           
            return $document_path;
        }



    public function interface_import_whatsapp($name,$mobile,$eticketpath)
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
            "countryCode": "+91",
            "phoneNumber": "'.$mobile.'",
            "callbackData": "some text here",
            "type": "Template",
            "template": {
                "name": "vip_import_interface_whatsapp_confimation_emailer",
                "languageCode": "en",
                "headerValues": [
                    "'.$eticketpath.'"
                ],
                "bodyValues": [
                    "'.$name.'"
                ]
            }
        }',
            CURLOPT_HTTPHEADER => array(
            'Authorization: Basic N2t6c29fZ1FsTk1haUtwOTQ4SGQzVTdfT3dOX1g3aHYwODJQYUJQYjhIZzo=',
            'Content-Type: application/json',
            'Cookie: ApplicationGatewayAffinity=a8f6ae06c0b3046487ae2c0ab287e175; ApplicationGatewayAffinityCORS=a8f6ae06c0b3046487ae2c0ab287e175'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
                    
    }

       


}
