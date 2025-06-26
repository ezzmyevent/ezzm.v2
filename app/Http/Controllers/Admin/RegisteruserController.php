<?php
    
namespace App\Http\Controllers\Admin;

use File;


use App\Models\User;
use App\Models\Uniquecode;
use App\Models\UserMember;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\OnlineRegisterEmail;
use Carbon\Carbon;
use App\Models\FieldSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Http\Controllers\Controller;
use DB, Storage, Validator, Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use function MongoDB\BSON\toRelaxedExtendedJSON;

use App\Http\Controllers\WhatsappmsgController;


class RegisteruserController extends Controller
{

    public function __construct() {
        $this->now = Carbon::now();
        $this->unicode_prefix = 'IMP23';
    }
    
    public function index(Request $request)
    {
        $title = 'Registered Users';
        $search = '';
        if(isset($request->search) && $request->search != '')
        {
            
                $pagination = 'no';
                    $search = $request->search;
                    $users = User::select("*")

                        ->where(function ($query) use ($request) {
                            $query->orWhere('category', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('emp_code', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('email', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('phone', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('company', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('unique_code', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('adult_1', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('adult_2', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('spouse', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('guest1_name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('guest2_name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('guest3_name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('kid_1', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('kid_2', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('kid1_name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('kid2_name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('status', 'LIKE', '%' . $request->search .'%');

                        })->where('user_type','online')
                        ->get();


        } else {
            $users = User::where('user_type','online')->paginate(25);
            $pagination = 'yes';

        }

        return View('admin.user.index', compact('title','users','pagination','search'));
    }
   


    public function OnsiteRegistrations(Request $request)
    {
        $title = 'Registered Users';
        $search = '';
        if(isset($request->search) && $request->search != '')
        {
            
                $pagination = 'no';
                    $search = $request->search;
                    $users = User::select("*")

                        ->where(function ($query) use ($request) {
                            $query->orWhere('category', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('emp_code', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('email', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('phone', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('company', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('unique_code', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('adult_1', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('adult_2', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('spouse', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('guest1_name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('guest2_name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('guest3_name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('kid_1', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('kid_2', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('kid1_name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('kid2_name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('status', 'LIKE', '%' . $request->search .'%');
                        })->where('user_type','onsite')
                        ->get();


        } else {
            $users = User::where('user_type','onsite')->paginate(25);
            $pagination = 'yes';

        }

        return View('admin.user.onsite-registrations', compact('title','users','pagination','search'));
    }
   

    public function view(Request $request)
    {
        $users = User::where('id', $request->id)->first();

        return view('admin.user.view')->with('users', $users);
    }

    public function add(Request $request)
    {
        return view('admin.user.add');
    }

    public function save(Request $request){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'emp_code' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            
        ],[
            'category.required' => 'Category is required.',
            'emp_code.required' => 'Employee Code is required.',
            // 'lead_name.required' => 'Practice Lead is required.',
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
          
        ]);

        if ($validator->passes()) {
            $users = new User();
            //$unique_code = $this->unicode_prefix.$this->unique_code();
            //$qrcode_path = $this->generateQr($unique_code);
            //$eticket_path = $this->eticket($qrcode_path,$unique_code,strtoupper($request->name),strtoupper($request->emp_code),$request->category);
            //dd($eticket_path);
            $data = [
                'user_type' => 'online',
                'category' => $request->category,
                'name' => $request->name,
                'email' => $request->email,
                // 'phone' => $request->phone,
               
                'emp_code' => $request->emp_code,
                // 'lead_name' => $request->lead_name,
                //'unique_code' => $unique_code,
                //'qrcode_path' => $qrcode_path,
                //'eticket_path' => $eticket_path,
                'status' => 0,
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ];
            //dd($data);
            $user_submit = $users->create($data);
            // if(!empty($user_submit)) {
            //         if ($user_submit->email != '') {
            //         $body = [
            //             'name' => $request->name,
            //             'email' => $request->email,
            //             'qrcode_path' => $qrcode_path,
            //             'eticket_path' => $eticket_path,
            //         ];
            //         Mail::to($request->email)->send(new OnlineRegisterEmail($body));
            //         User::where('id',$user_submit->id)->update(['email_send' =>1]);   
            //     }
            //     // if(!empty($request->phone)){
            //     //     (new WhatsappmsgController)->confirmation_msg("+91",$request->phone,ucwords($request->name),$eticket_path,$user_submit->id); 
            //     //     User::where('id',$user_submit->id)->update(['send_whatsapp' =>1]);    
            //     // }

            // }
        } else {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }


    public function resendmail(Request $request){
        $id = $request->id;
        $childusersdata = User::where('id',$id)->first();
        if(!empty($childusersdata)) {
                if ($childusersdata->email != '') {
                User::where('id',$childusersdata->id)->update(['email_send' =>0]);   
            }
            if(!empty($childusersdata->phone)){
                // (new WhatsappmsgController)->confirmation_msg("+91",$childusersdata->phone,ucwords($childusersdata->name),
                //     $childusersdata->eticket_path,$childusersdata->id); 
                User::where('id',$childusersdata->id)->update(['send_whatsapp' =>0]);    
            }
        }
        $data = array('type' => 'Success', 'message' => 'Email / Whatsapp  Resend Successfully.');       
        echo json_encode($data);
        exit();
    }

    public function onspot(Request $request)
    {
        $title = 'Onspot Registered Users';
        $search = '';
        if(isset($request->search) && $request->search != '')
        {
            $pagination = 'no';
            $search = $request->search;
            $users = User::select("*")
                ->where(function ($query) use ($request) {
                    $query->orWhere('category', 'LIKE', '%' . $request->search .'%');
                    $query->orWhere('name', 'LIKE', '%' . $request->search .'%');
                    $query->orWhere('email', 'LIKE', '%' . $request->search .'%');
                    $query->orWhere('phone', 'LIKE', '%' . $request->search .'%');
                    $query->orWhere('company', 'LIKE', '%' . $request->search .'%');
                    $query->orWhere('unique_code', 'LIKE', '%' . $request->search .'%');
                })->where('user_type','onsite')
                ->get();


        } else {

            $users = User::where('user_type','onsite')->paginate(25);
            $pagination = 'yes';

        }

        return View('admin.user.onspot', compact('title','users','pagination','search'));
    }

    public function entry_zapping(Request $request)
    {
        $title = 'Entry Zapping Users';
        $search = '';
        if(isset($request->search) && $request->search != '')
        {
            $pagination = 'no';
            $search = $request->search;
            $users = DB::table('entry_zapping')->join('users', 'users.unique_code', '=', 'entry_zapping.unique_code')->select("*")
                        ->when($request->search, function ($query) use ($request) {
                            $query->where('name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('email', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('unique_code', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('location', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('type', 'LIKE', '%' . $request->search .'%');
                        })->get();


        } else {

            $users = DB::table('entry_zapping')->join('users', 'users.unique_code', '=', 'entry_zapping.unique_code')->paginate(25);
            $pagination = 'yes';

        }

        return View('admin.user.entryzapping', compact('title','users','pagination','search'));
    }


    public function Feedback(Request $request)
    {
        $title = 'Feedback';
        $search = '';

        if(isset($request->search) && $request->search != '')
        {
            $pagination = 'no';

            $search =   $request->search;
            $users =    DB::table('feedback')                        
                        ->when($request->search, function ($query) use ($request) {
                            $query->where('name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('email', 'LIKE', '%' . $request->search .'%');
                        })
                        ->get();
        }
        else
        {
            $users = DB::table('feedback')->paginate(25);
            $pagination = 'yes';
        }

        return View('admin.user.feedback', compact('title','users','pagination','search'));
    }

    public function feedbackExport()
    {
        $result = DB::table('feedback')->get();
        $filename = "Feedback_Reports.csv";

        $headerRow = array('Name','Email','Mobile No','Feed 1','Feed 2','Feed 3','Feed 4','Feed 5','Feed 6','Feed 7','Feed 8','Created');

        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);


        foreach($result as $data)
        {
            $arr = [];
            $arr[] = $data->name;
            $arr[] = $data->email;
            $arr[] = $data->mobile_no;
            $arr[] = $data->feed_1;
            $arr[] = $data->feed_2;
            $arr[] = $data->feed_3;
            $arr[] = $data->feed_4;
            $arr[] = $data->feed_5;
            $arr[] = $data->feed_6;
            $arr[] = $data->feed_7;
            $arr[] = $data->feed_8;

            if($data->created_at)
            {
                $arr[] = date('Y-m-d h:i:s A', strtotime($data->created_at));
            }


            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        fclose($csvFile);
    }


    public function feedback_view(Request $request)
    {
        $feedback_data = DB::table('feedback')->where('user_id', $request->id)->first();

        return view('admin.user.feedback_view')->with('feedback', $feedback_data);
    }

    public function emailUser(Request $request)
    {
        $id = $request->id;
        $user = DB::table('users')->where('id',$id)->first();
        if(empty($user->unique_code)){
            $unique_code = 'ID22'.$this->unique_code();
            $qrcode_path = $this->generateQr($unique_code, 'General');
            $eticket_path = $this->eticket($qrcode_path, $unique_code);

            User::where('id', $id)->update(['unique_code' => $unique_code, 'qrcode_path' => $qrcode_path,
             'eticket_path' => $eticket_path]);
        } else{
            $unique_code = $user->unique_code;
            $qrcode_path = $user->qrcode_path;
            $eticket_path = $user->eticket_path;

        }

        
        $body = [
            'id' => $id,
            'name' => $user->name,
            'email' => $user->email,
            'qr_code' => $unique_code,
            'qr_path' => $qrcode_path,
            'dates' => $user->festival_dates,
        ];

        $this->resend_registration_confirm_whatsapp($user->name,$user->phone,$eticket_path,$user->festival_dates);
        Mail::to($user->email)->send(new RegisterEmail($body));

        $data = array('type' => 'Success', 'message' => 'Email Resend Successfully.');       
        echo json_encode($data);
        exit();
    }

    public function unique_code()
    {
        $unique_code = DB::table('online_registration_unique_codes')->where('is_used', 0)->first();
        DB::table('online_registration_unique_codes')->where('id', $unique_code->id)->update(['is_used' => 1, 'modified' => Carbon::now()]);
        return $unique_code->unique_code;        
    }

    public function generateQr($unique_code){
        $document = QrCode::format('png')->margin(2)->size(350)->backgroundColor(255, 255, 255)->generate($unique_code);
        $upload_name= "Smart-Reg/LKQI/qrcodes/".$unique_code.".png";
        $document_path = Storage::disk('s3')->put($upload_name, $document, 'public');
        $document_path = Storage::disk('s3')->url($upload_name);
        return $document_path;
    }


    function ImageTTFCenter($image, $text, $font, $size, $angle = 0){
        $xi = imagesx($image);
        $yi = imagesy($image);

        $box = imagettfbbox($size, $angle, $font, $text);

        $xr = abs(max($box[2], $box[4]));
        $yr = abs(max($box[5], $box[7]));

        $x = intval(($xi - $xr) / 2);
        $y = intval(($yi + $yr) / 2);
        // die();

        return array($x, $y);
    }


    public function eticket($qr_path,$unique_code,$name,$emp_code,$category,$adultcount,$kids){
        
        $new = imagecreatefrompng($qr_path);
        if($category == 'Employee'){
            $master = imagecreatefrompng('public/sangama.png');
        }
        imagecopymerge($master, $new, 320, 480, 0, 0, 350, 350, 100);
        $white = imagecolorallocate($master, 0, 0, 0);
        $font = realpath('public/Axiforma-Bold.ttf');
    
        //Unique Code Print ============================================================================================================================
        $unique_code_font_size = 20;
        list($x, $y) = $this->ImageTTFCenter($master, $unique_code, $font, $unique_code_font_size);
        imagettftext($master, $unique_code_font_size, 0, $x, 900, $white, $font, $unique_code);

        //Name Print ===================================================================================================================================
        // $nameLen = strlen($name);
        // if($nameLen < 25 ) {
        //     $name_font_size = 40;
        // }else {
        //     $name_font_size = 30;
        // }
        // list($x, $y) = $this->ImageTTFCenter($master, $name, $font, $name_font_size);
        // imagettftext($master, $name_font_size, 0, $x, 530, $white, $font, $name);

        $first_name = $name;
        $new_first_name = wordwrap($first_name, 30, "<br>\n");
        $new_first_name = str_replace(array("\r", "\n"), '', $new_first_name);
        $final_new_first_name = explode('<br>', $new_first_name);
        $first_name_count = count($final_new_first_name);
        if (!empty($first_name)) {
            if ($first_name_count == 1) {
                if (strlen($first_name) < 20) {
                    $first_name_font_size = 50;
                } else if (strlen($first_name) >= 20 && strlen($first_name) < 25) {
                    $first_name_font_size = 45;
                } else if (strlen($first_name) >= 25) {
                    $first_name_font_size = 35;
                }
                $fname1 = $final_new_first_name[0];
                list($x, $y) = $this->ImageTTFCenter($master, $fname1, $font, $first_name_font_size);
                imagettftext($master, $first_name_font_size, 0, $x, 420, $white, $font, $fname1);
            }
            else if ($first_name_count == 2) {
                $first_name_font_size = 35;

                $fname1 = $final_new_first_name[0];
                list($x, $y) = $this->ImageTTFCenter($master, $fname1, $font, $first_name_font_size);
                imagettftext($master, $first_name_font_size, 0, $x, 420, $white, $font, $fname1);

                $fname2 = $final_new_first_name[1];
                list($x, $y) = $this->ImageTTFCenter($master, $fname2, $font, $first_name_font_size);
                imagettftext($master, $first_name_font_size, 0, $x, 440, $white, $font, $fname2);
            }
        }
        //adult count
        $emp_code_font_size = 30;
        list($x, $y) = $this->ImageTTFCenter($master, $adultcount, $font, $emp_code_font_size);
        imagettftext($master, $emp_code_font_size, 0, 365, 1122, $white, $font, $adultcount);


        //kids count
        $emp_code_font_size = 30;
        list($x, $y) = $this->ImageTTFCenter($master, $kids, $font, $emp_code_font_size);
        imagettftext($master, $emp_code_font_size, 0, 732, 1122, $white, $font, $kids);

        // header('Content-Type: image/png');
        $masterImg= imagepng($master,'public/eticket/'.$unique_code.".png");

        if($masterImg){
            $upload_name= "Smart-Reg/LKQI/eticket/".$unique_code.".png";
            $eticketpath = Storage::disk('s3')->put($upload_name, file_get_contents('public/eticket/'.$unique_code.'.png'), 'public');
            $eticketpath = Storage::disk('s3')->url($upload_name);
            unlink('public/eticket/'.$unique_code.'.png');

        }
        return $eticketpath;
    }

    public function resend_registration_confirm_whatsapp($name,$mobile,$eticketpath,$date)
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
                "name": "registration_confirmation_emailer_id22",
                "languageCode": "en",
                "headerValues": [
                    "'.$eticketpath.'"
                ],
                "bodyValues": [
                    "'.$name.'",
                    "'.$date.'"
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
        // dd($response);                
    }

    public function import()
    {
        return View('admin.user.import');
    }
    public function sampleExcel(){
        $filename = " samplecsv.csv";
        $headerRow = [
            'Category',
            'Employee Code',
            'Name',
            'Email',
            'Phone',
            'Country Code'
        ];
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        fclose($csvFile);
    }

    public function uploadcsv(Request $request){
        if(!empty($request->file)) {
            $date = date('Y-m-d H:i:s');    
            $target_file = $_FILES["file"]["tmp_name"];
            $csvFile = fopen($target_file, 'r');
            $i = 0;
            while (($row = fgetcsv($csvFile)) !== FALSE) {
                
               $user_exist = User::where('emp_code', $row[1])->count();
                if($i > 0 && $user_exist == 0) {
                    //$unique_code = $this->unicode_prefix.$this->unique_code();
                    //$qrcode_path = $this->generateQr($unique_code);
                    //$eticket_path = $this->eticket($qrcode_path,$unique_code,strtoupper(trim($row[3])),strtoupper(trim($row[2])),trim($row[0]));
                    $data_array = [
                        'user_type'     => 'online',
                        'category'      => 'Employee',
                        'emp_code'      => trim($row[1]),
                        // 'lead_name'     => trim($row[2]),
                        'name'          => trim($row[2]),
                        'email'         => trim($row[3]),
                      
                        'country_code'  => '+91',
                        //'unique_code'  => $unique_code,
                        //'qrcode_path'  => $qrcode_path,
                       // 'eticket_path' => $eticket_path,
                        'status'       => 0,
                        'created_at'   => $this->now,
                        'updated_at'   => $this->now,
                    ];
                    // echo "<pre>";print_r($data_array);die;

                    $result = DB::table('users')->insert($data_array);
                }
            $i++;
            }
            $data = array('type' => 'Success', 'message' => 'All users added successfully.');
        } else {
            return response()->json(['error'=>['Please upload a valid file.']]);
        }

        echo json_encode($data);
        exit();
    }

    public function uploadcsvnew(Request $request){
        if(!empty($request->file)) {
            $date = date('Y-m-d H:i:s');    
            $target_file = $_FILES["file"]["tmp_name"];
            $csvFile = fopen($target_file, 'r');
            $i = 0;
            while (($row = fgetcsv($csvFile)) !== FALSE) {
                
               $user_exist = User::where('emp_code', $row[0])->first();
                if($i > 0 && !empty($user_exist)) {
                    $unique_code = $user_exist->emp_code;
                    $qrcode_path = $this->generateQr($unique_code);

                    
                    $adultcount = 0;    
                    $adultcount = $row[5] != null && $row[5] != 'No' ? 1 :0;
                    $adultcount += $row[6] != null && $row[6] != 'No' ? 1 :0;
                    $adultcount += $row[7] != null && $row[7] != 'No' ? 1 :0;

                    $kids = 0;    
                    $kids = $row[8] != null && $row[8] != 'No' ?  1 :0;
                    $kids += $row[9] != null && $row[9] != 'No' ? 1 :0;

                    
                    $eticket_path = $this->eticket($qrcode_path,$unique_code,strtoupper($row[2]),strtoupper($user_exist->emp_code),$user_exist->category,$adultcount,$kids);
                    $data_array = [
                        'name' => trim($row[2]),
                        'email' => trim($row[3]),
                        'phone' => trim($row[4]),
                        'qrcode_path'  => $qrcode_path,
                        'eticket_path' => $eticket_path,
                        'adult_1' => trim($row[5]),
                        'adult_2' => trim($row[6]),
                        'spouse' => trim($row[7]),
                        'kid_1' => trim($row[8]),
                        'kid_2' => trim($row[9]),
                        'guest1_name' => trim($row[10]),
                        'guest2_name' => trim($row[11]),
                        'guest3_name' => trim($row[12]),
                        'kid1_name' => trim($row[13]),
                        'kid2_name' => trim($row[14]),
                        'status'       => 1,
                        'created_at'   => $this->now,
                        'updated_at'   => $this->now,
                    ];
                    // echo "<pre>";print_r($data_array);die;
                    $result = DB::table('users')->where('emp_code', $row[0])->update($data_array);
                }
            $i++;
            }
            $data = array('type' => 'Success', 'message' => 'All users added successfully.');
        } else {
            return response()->json(['error'=>['Please upload a valid file.']]);
        }

        echo json_encode($data);
        exit();
    }

    public function changeStatus(Request $request)
    {
        $status = $request->input('status');
        $id = $request->input('id');

        $last_id = User::where('id', $id)->update(['status' => $status]);

        $data = array('type' => 'Success', 'message' => 'Status updated successful.');

        echo json_encode($data);
        exit();
    }

    public function deleteUser(Request $request)
    {
        $id = $request->input('id');

        User::where('id', $id)->delete();

        $data = array('type' => 'Success', 'message' => 'User deleted successful.');       

        echo json_encode($data);
        exit();
    }
    
    public function resetUsers()
    {
        User::truncate();
        exit();
    }

    public function exportUsers()
    {
        $result = User::where('status',1)->where('user_type','online')->select('users.*')->get();
        $filename = "Successful_Registered_User_Reports.csv";
        
        $headerRow = array('Employee Code','Name','Email','Phone Number','Adult 1', 'Adult 2', 'Adult 3', 'Kid 1', 'Kid 2','Adult 1 Name','Adult 2 Name','Adult 3 Name','Kid 1','Kid 2','Total Member','Attendees','Unique Code','Created','is printed','is printed adult1','is printed adult2','is printed adult3','is printed kid1','is printed kid2');
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        
// echo "<pre>";print_r($result);die;
        foreach($result as $data)
        {
           
            $slotCount = 0;
            $attendslotCount = 0;
            $arr = [];
            $arr[] = $data->emp_code;
            $arr[] = $data->name;
            $arr[] = $data->email;
            $arr[] = '(' . $data->country_code . ') ' . $data->phone;
            $arr[] = $data->adult_1;
            $arr[] = $data->adult_2;
            $arr[] = $data->spouse;
            $arr[] = $data->kid_1 == '7-12' ? '7 to 12' : $data->kid_1;
            $arr[] = $data->kid_2 == '7-12' ? '7 to 12' : $data->kid_2;

            $arr[] = $data->guest1_name;
            $arr[] = $data->guest2_name;
            $arr[] = $data->guest3_name;
            $arr[] = $data->kid1_name;
            $arr[] = $data->kid2_name;

           

            if($data->adult_1 != 'No' && $data->adult_1 != null){
               $slotCount += 1;
            }

            if($data->adult_2 != 'No'  && $data->adult_2 != null){
               $slotCount += 1;
            }

            if($data->spouse != 'No' && $data->spouse != null){
               $slotCount += 1;
            }

            if($data->kid_1 != 'No' && $data->kid_1 != null){
               $slotCount += 1;
            }

            if($data->kid_2 != 'No' && $data->kid_2 != null){
               $slotCount += 1;
            }

            if($data->event_status == 1){
                $slotCount += 1;
             }


            $arr[] = $slotCount;

            if($data->event_status == 1)
             {
                $arr[] = 'Yes';
             }
             else
             {
                $arr[] = 'No';
             }


           

            $arr[] = $data->unique_code;
           
            if($data->created_at)
            {
                $arr[] = date('Y-m-d h:i:s A', strtotime($data->created_at));
            }
            $arr[] = $data->is_printed;
            $arr[] = $data->is_printed_adult_1;
            $arr[] = $data->is_printed_adult_2;
            $arr[] = $data->is_printed_adult_3;
            $arr[] = $data->is_printed_kid_1;
            $arr[] = $data->is_printed_kid_2;


            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        fclose($csvFile);
    }

    public function exportZappingUsers()
    {
        $result = User::join('entry_zapping','entry_zapping.unique_code','users.unique_code')->where('users.status',1)->select('users.*')->get();
        $filename = "Successful_Registered_User_Reports.csv";
        
        $headerRow = array('Employee Code','Name','Email','Phone Number','Adult 1', 'Adult 2', 'Adult 3', 'Kid 1', 'Kid 2','Adult 1 Name','Adult 2 Name','Adult 3 Name','Kid 1','Kid 2','Total Member','Attendees','Unique Code','Created','is printed','is printed adult1','is printed adult2','is printed adult3','is printed kid1','is printed kid2');
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        
// echo "<pre>";print_r($result);die;
        foreach($result as $data)
        {
            $slotCount = 0;
            $attendslotCount = 0;
            $arr = [];
            $arr[] = $data->emp_code;
            $arr[] = $data->name;
            $arr[] = $data->email;
            $arr[] = '(' . $data->country_code . ') ' . $data->phone;
            $arr[] = $data->adult_1;
            $arr[] = $data->adult_2;
            $arr[] = $data->spouse;
            $arr[] = $data->kid_1 == '7-12' ? '7 to 12' : $data->kid_1;
            $arr[] = $data->kid_2 == '7-12' ? '7 to 12' : $data->kid_2;

            $arr[] = $data->guest1_name;
            $arr[] = $data->guest2_name;
            $arr[] = $data->guest3_name;
            $arr[] = $data->kid1_name;
            $arr[] = $data->kid2_name;

           

            if($data->adult_1 != 'No' && $data->adult_1 != null){
               $slotCount += 1;
            }

            if($data->adult_2 != 'No'  && $data->adult_2 != null){
               $slotCount += 1;
            }

            if($data->spouse != 'No' && $data->spouse != null){
               $slotCount += 1;
            }

            if($data->kid_1 != 'No' && $data->kid_1 != null){
               $slotCount += 1;
            }

            if($data->kid_2 != 'No' && $data->kid_2 != null){
               $slotCount += 1;
            }

            if($data->event_status == 1){
                $slotCount += 1;
             }


            $arr[] = $slotCount;

            if($data->event_status == 1)
             {
                $arr[] = 'Yes';
             }
             else
             {
                $arr[] = 'No';
             }


           

            $arr[] = $data->unique_code;
           
            if($data->created_at)
            {
                $arr[] = date('Y-m-d h:i:s A', strtotime($data->created_at));
            }
            $arr[] = $data->is_printed;
            $arr[] = $data->is_printed_adult_1;
            $arr[] = $data->is_printed_adult_2;
            $arr[] = $data->is_printed_adult_3;
            $arr[] = $data->is_printed_kid_1;
            $arr[] = $data->is_printed_kid_2;
            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        fclose($csvFile);
    }
    

    public function exportUsersAll()
    {
        $result = User::join('entry_zapping','entry_zapping.unique_code','users.unique_code')->where('users.status',1)->select('users.*')->get();
        $filename = "export_onlines_user.csv";
        //dd($result);
        //$headerRow = array('Employee Code','Name','Phone','Email', 'Adult 1', 'Adult 2', 'Spouse', 'Kid 1', 'Kid 2','Total Member','Unique Code','Created');
     
        $headerRow = array('Employee Code','Status','Name','Email','Phone Number','Adult 1', 'Adult 2', 'Adult 3', 'Kid 1', 'Kid 2','Adult 1 Name','Adult 2 Name','Adult 3 Name','Kid 1','Kid 2','Total Member','Attendees','Unique Code','Created','is printed','is printed adult1','is printed adult2','is printed adult3','is printed kid1','is printed kid2');
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        
        foreach($result as $data)
        {
            $slotCount = 0;
            $attendslotCount = 0;
            $arr = [];
            $arr[] = $data->emp_code;
            if($data->status == 1)
            {
                $arr[] = 'Successful';
            }
            else
            {
                $arr[] = 'Pending';
            }
            $arr[] = $data->name;
            $arr[] = $data->email;
            $arr[] = '(' . $data->country_code . ') ' . $data->phone;
            $arr[] = $data->adult_1;
            $arr[] = $data->adult_2;
            $arr[] = $data->spouse;
            $arr[] = $data->kid_1;
            $arr[] = $data->kid_2;

            $arr[] = $data->guest1_name;
            $arr[] = $data->guest2_name;
            $arr[] = $data->guest3_name;
            $arr[] = $data->kid1_name;
            $arr[] = $data->kid2_name;

            

            if($data->adult_1 != 'No' && $data->adult_1 != null){
                $slotCount += 1;
             }
 
             if($data->adult_2 != 'No'  && $data->adult_2 != null){
                $slotCount += 1;
             }
 
             if($data->spouse != 'No' && $data->spouse != null){
                $slotCount += 1;
             }
 
             if($data->kid_1 != 'No' && $data->kid_1 != null){
                $slotCount += 1;
             }
 
             if($data->kid_2 != 'No' && $data->kid_2 != null){
                $slotCount += 1;
             }
 


          

            $arr[] = $slotCount;
            $arr[] = $data->unique_code;
             if($data->event_status == 1)
             {
                $arr[] = 'Yes';
             }
             else
             {
                $arr[] = 'No';
             }
            if($data->created_at)
            {
                $arr[] = date('Y-m-d h:i:s A', strtotime($data->created_at));
            }
            $arr[] = $data->is_printed;
            $arr[] = $data->is_printed_adult_1;
            $arr[] = $data->is_printed_adult_2;
            $arr[] = $data->is_printed_adult_2;
            $arr[] = $data->is_printed_kid_1;
            $arr[] = $data->is_printed_kid_2;

            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        fclose($csvFile);
    }
   public function exportRedemptionUsers()
   {
  $result = User::join('entry_zapping','entry_zapping.unique_code','users.unique_code')->where('users.status',1)->select('users.*')->get();
        $filename = "Successful_Registered_User_Reports.csv";
        
        $headerRow = array('Kid 1', 'Kid 2');
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        $test = ['No','',null,'13-18'];
        $test1 = ['No','',null,'13-18'];
// echo "<pre>";print_r($result);die;


foreach($result as $key => $val)
        {
            if($val->kid_1 == '0-6' && $val->is_printed_kid_1 == 1)
            {
                $c = $c+1;
            }

            if($val->kid_2 == '0-6' && $val->is_printed_kid_2 == 1)
            {
                $c = $c+1;
            }

            if($val->kid_1 == '7-12' && $val->is_printed_kid_1 == 1)
            {
                $c = $c+1;
            }

            if($val->kid_2 == '7-12' && $val->is_printed_kid_2 == 1)
            {
                $c = $c+1;
            }
        }
        
        foreach($result as $data)
        {
            $slotCount = 0;
            $attendslotCount = 0;
            $arr = [];
            if(!in_array($data->kid_1,$test))
            {
                $arr[] = $data->kid_1 == '7-12' ? '7 to 12' : $data->kid_1;
            }

            if(!in_array($data->kid_2,$test))
            {
                $arr[] = $data->kid_2 == '7-12' ? '7 to 12' : $data->kid_2;
            }


            $arr[] = $data->is_printed_kid_1;
            $arr[] = $data->is_printed_kid_2;
            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        fclose($csvFile);
   }

    public function exportonsiteuser()
    {
        $result = User::where('user_type','onsite')->get();
        $filename = "export_site_user.csv";
        //dd($result);
        //$headerRow = array('Employee Code','Name','Phone','Email', 'Adult 1', 'Adult 2', 'Spouse', 'Kid 1', 'Kid 2','Total Member','Unique Code','Created');
     
        $headerRow = array('Employee Code','Status','Name','Email','Phone Number','Adult 1', 'Adult 2', 'Adult 3', 'Kid 1', 'Kid 2','Adult 1 Name','Adult 2 Name','Adult 3 Name','Kid 1','Kid 2','Total Member','Attendees','Unique Code','Created','is printed','is printed adult1','is printed adult2','is printed adult3','is printed kid1','is printed kid2');
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        
        foreach($result as $data)
        {
            $slotCount = 0;
            $attendslotCount = 0;
            $arr = [];
            $arr[] = $data->emp_code;
            if($data->status == 1)
            {
                $arr[] = 'Successful';
            }
            else
            {
                $arr[] = 'Pending';
            }
            $arr[] = $data->name;
            $arr[] = $data->email;
            $arr[] = '(' . $data->country_code . ') ' . $data->phone;
            $arr[] = $data->adult_1;
            $arr[] = $data->adult_2;
            $arr[] = $data->spouse;
            $arr[] = $data->kid_1;
            $arr[] = $data->kid_2;

            $arr[] = $data->guest1_name;
            $arr[] = $data->guest2_name;
            $arr[] = $data->guest3_name;
            $arr[] = $data->kid1_name;
            $arr[] = $data->kid2_name;

            

            if($data->adult_1 != 'No' && $data->adult_1 != null){
                $slotCount += 1;
             }
 
             if($data->adult_2 != 'No'  && $data->adult_2 != null){
                $slotCount += 1;
             }
 
             if($data->spouse != 'No' && $data->spouse != null){
                $slotCount += 1;
             }
 
             if($data->kid_1 != 'No' && $data->kid_1 != null){
                $slotCount += 1;
             }
 
             if($data->kid_2 != 'No' && $data->kid_2 != null){
                $slotCount += 1;
             }
 


          

            $arr[] = $slotCount;
            $arr[] = $data->unique_code;
             if($data->event_status == 1)
             {
                $arr[] = 'Yes';
             }
             else
             {
                $arr[] = 'No';
             }
            if($data->created_at)
            {
                $arr[] = date('Y-m-d h:i:s A', strtotime($data->created_at));
            }
            $arr[] = $data->is_printed;
            $arr[] = $data->is_printed_adult_1;
            $arr[] = $data->is_printed_adult_2;
            $arr[] = $data->is_printed_adult_2;
            $arr[] = $data->is_printed_kid_1;
            $arr[] = $data->is_printed_kid_2;

            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        fclose($csvFile);
    }

    

    public function exportUsersAllOnsite()
    {
        $result = User::where('user_type','onsite')->get();
        $filename = "export_onsite_user.csv";
        //dd($result);
        //$headerRow = array('Employee Code','Name','Phone','Email', 'Adult 1', 'Adult 2', 'Spouse', 'Kid 1', 'Kid 2','Total Member','Unique Code','Created');
     
        $headerRow = array('Employee Code','Status','Name','Email','Phone Number','Adult 1', 'Adult 2', 'Adult 3', 'Kid 1', 'Kid 2','Adult 1 Name','Adult 2 Name','Adult 3 Name','Kid 1','Kid 2','Total Member','Attendees','Unique Code','Created','is printed','is printed adult1','is printed adult2','is printed adult3','is printed kid1','is printed kid2');
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        
        foreach($result as $data)
        {
            $slotCount = 0;
            $attendslotCount = 0;
            $arr = [];
            $arr[] = $data->emp_code;
            if($data->status == 1)
            {
                $arr[] = 'Successful';
            }
            else
            {
                $arr[] = 'Pending';
            }
            $arr[] = $data->name;
            $arr[] = $data->email;
            $arr[] = '(' . $data->country_code . ') ' . $data->phone;
            $arr[] = $data->adult_1;
            $arr[] = $data->adult_2;
            $arr[] = $data->spouse;
            $arr[] = $data->kid_1;
            $arr[] = $data->kid_2;

            $arr[] = $data->guest1_name;
            $arr[] = $data->guest2_name;
            $arr[] = $data->guest3_name;
            $arr[] = $data->kid1_name;
            $arr[] = $data->kid2_name;

            

            if($data->adult_1 != 'No' && $data->adult_1 != null){
                $slotCount += 1;
             }
 
             if($data->adult_2 != 'No'  && $data->adult_2 != null){
                $slotCount += 1;
             }
 
             if($data->spouse != 'No' && $data->spouse != null){
                $slotCount += 1;
             }
 
             if($data->kid_1 != 'No' && $data->kid_1 != null){
                $slotCount += 1;
             }
 
             if($data->kid_2 != 'No' && $data->kid_2 != null){
                $slotCount += 1;
             }
 


          

            $arr[] = $slotCount;
            $arr[] = $data->unique_code;
             if($data->event_status == 1)
             {
                $arr[] = 'Yes';
             }
             else
             {
                $arr[] = 'No';
             }
            if($data->created_at)
            {
                $arr[] = date('Y-m-d h:i:s A', strtotime($data->created_at));
            }
            $arr[] = $data->is_printed;
            $arr[] = $data->is_printed_adult_1;
            $arr[] = $data->is_printed_adult_2;
            $arr[] = $data->is_printed_adult_2;
            $arr[] = $data->is_printed_kid_1;
            $arr[] = $data->is_printed_kid_2;


            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        fclose($csvFile);
    }

    public function onspotExportUsers()
    {
        $result = User::where('status',1)->where('slot','!=',Null)->where('is_goodies',1)->get();
        $filename = "Goodies_Registered_User_Reports.csv";
        
        $headerRow = array('Arrival Date','Employee Code','Practice Lead','Name','Email','Slot','Kid 1', 'Kid 2','Total Kids','Unique Code','Created');
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        

        foreach($result as $data)
        {
            $memberCount = 0;
            $arr = [];
            $arr[] = $data->date;
            $arr[] = $data->emp_code;
            $arr[] = $data->lead_name;
            $arr[] = $data->name;
            $arr[] = $data->email;
            $arr[] = $data->slot;
            $arr[] = $data->kid_1;
            $arr[] = $data->kid_2;
                
                if($data->is_goodies_kid_1 == 1){
                   $memberCount += 1;
                }

                if($data->is_goodies_kid_2 == 1){
                   $memberCount += 1;
                }
            
            $arr[] = $memberCount;
            $arr[] = $data->unique_code;
           
            if($data->created_at)
            {
                $arr[] = date('Y-m-d h:i:s A', strtotime($data->created_at));
            }


            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        fclose($csvFile);
    }

    public function onspotExportUsersAll()
    {
        $result = User::where('status',1)->where('user_type','onsite')->select('name','email','company','category','designation','unique_code','attendance_ballroom','attendance_lunch','created_at')->get();
        $filename = "Onspot_Registered_User_Reports_All.csv";
        
        $headerRow = array('Name','Email','Company','Category','Designation','Unique Code','Created');

        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);


        foreach($result as $data)
        {
            $arr = [];
            $arr[] = $data->name;
            $arr[] = $data->email;
            $arr[] = $data->company;
            $arr[] = $data->category;
            $arr[] = $data->designation;
            $arr[] = $data->unique_code;
           
            if($data->created_at)
            {
                $arr[] = date('Y-m-d h:i:s A', strtotime($data->created_at));
            }

            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        fclose($csvFile);
    }

    


    public function exportCategorywise($type, $category)
    {
        $result =   User::where('status',1)
                    ->select('name','email','company','category','designation','unique_code','attendance_ballroom','attendance_lunch','created_at')
                    ->where('user_type',$type)
                    ->where('category',$category)
                    ->where('is_printed',1)
                    ->get();

        $filename = $type.'_'.$category.'_Redeem_User_Reports.csv';
        
        $headerRow = array('Name','Email','Company', 'Category', 'Designation','Unique Code','Created');
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);

        foreach($result as $data)
        {
            $arr = [];
            $arr[] = $data->name;
            $arr[] = $data->email;
            $arr[] = $data->company;
            $arr[] = $data->category;
            $arr[] = $data->designation;
            $arr[] = $data->unique_code;
           
            if($data->created_at)
            {
                $arr[] = date('Y-m-d h:i:s A', strtotime($data->created_at));
            }

            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        fclose($csvFile);
    }


    public function exportLocationWiseZapping($type, $location)
    {
        $result =   User::join('entry_zapping', 'entry_zapping.unique_code', 'users.unique_code')
                    ->select(
                        'users.name',
                        'users.email',
                        'users.company',
                        'users.category',
                        'users.designation',
                        'users.unique_code',
                        'entry_zapping.location',
                        'entry_zapping.type',
                        'entry_zapping.created_at'
                    )
                    ->where('entry_zapping.type',$type)
                    ->where('entry_zapping.location',$location)                    
                    ->get();

        $filename = $location.' '.$type.'_Zapping_User_Reports.csv';
        
        $headerRow = array('Name', 'Email', 'Company', 'Category', 'Designation', 'Unique Code', 'Location', 'Type', 'Created');
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);

        foreach($result as $data)
        {
            $arr = [];
            $arr[] = $data->name;
            $arr[] = $data->email;
            $arr[] = $data->company;
            $arr[] = $data->category;
            $arr[] = $data->designation;
            $arr[] = $data->unique_code;
            $arr[] = $data->location;
            $arr[] = $data->type;
           
            if($data->created_at)
            {
                $arr[] = date('Y-m-d h:i:s A', strtotime($data->created_at));
            }

            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }
        
        fclose($csvFile);
    }

    public function exportAttendees() {
        $result = User::where('total_log', '>', 0)->get();

        $filename = "Attendees Reports.csv";

        $field_values =   FieldSetting::select('field_title', 'field_value')->where('export', 1)->get();

        foreach ($field_values as $fields) {
            $field_title_pass[] = $fields->field_title;
            $field_value_pass[] = $fields->field_value;                        
        }

        array_push($field_title_pass, "Stay Time","Registration Date","Last Login");
        array_push($field_value_pass, "stayTime","created_at","lastLogin");

        $headerRow = $field_title_pass;

        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);

        $value_array = $field_value_pass;

        foreach($result as $data)
        {
            $arr = [];
            foreach($value_array as $value)
            {                
                if($value == 'created_at')
                {
                    $arr[] = date('Y-m-d h:i:s A', strtotime($data[$value]));
                }   
                else if($value == 'stayTime')
                {
                    if($data[$value] != '')
                    {
                        $init = $data[$value];
                        $hours = floor($init / 3600);
                        $minutes = floor(($init / 60) % 60);
                        $seconds = $init % 60;
                        
                        $arr[] = "$hours:$minutes:$seconds";
                    }
                    else
                    {
                        $arr[] = "00:00:00";
                    }
                
                }
                else if($value == 'lastLogin')
                {
                    if($data[$value] != '')
                    {
                        $arr[] = date('Y-m-d H:i:s', strtotime($data[$value]));
                    }
                    else
                    {
                        $arr[] = '';
                    }
                }
                else
                {
                    $arr[] = $data[$value];
                }            
            }

            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }

        fclose($csvFile);
    }

    public function exportAttendeesByDate(Request $request) 
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $result = DB::table('user_logs as c')
            ->select(DB::raw("COUNT(c.created_at) AS login_count"), 'u.*', DB::Raw('DATE(c.created_at) log_date'))
            ->leftJoin('users as u', 'c.user_id', '=', 'u.id')
            ->whereDate('c.created_at', '>=', $start_date)
            ->whereDate('c.created_at', '<=', $end_date)
            ->where('u.total_log', '>', 0)
            ->where('c.action', '=', 'Login')
            ->groupBy('c.user_id', 'log_date')
            ->get();
        
        $filename = "Attendees Reports.csv";

        $field_values = FieldSetting::select('field_title', 'field_value')->where('export', 1)->get();

        foreach ($field_values as $fields) {
            $field_title_pass[] = $fields->field_title;
            $field_value_pass[] = $fields->field_value;                        
        }

        array_push($field_title_pass, "Stay Time","Registration Date","Login Date","Login Count");
        array_push($field_value_pass, "stayTime","created_at","log_date","login_count");

        $headerRow = $field_title_pass;

        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);

        $value_array = $field_value_pass;

        foreach($result as $data)
        {
            $arr = [];
            foreach($value_array as $value)
            {                
                if($value == 'created_at')
                {
                    $arr[] = date('Y-m-d h:i:s A', strtotime($data->$value));
                }
                else if($value == 'stayTime')
                {
                    if($data[$value] != '')
                    {
                        $init = $data[$value];
                        $hours = floor($init / 3600);
                        $minutes = floor(($init / 60) % 60);
                        $seconds = $init % 60;
                        
                        $arr[] = "$hours:$minutes:$seconds";
                    }
                    else
                    {
                        $arr[] = "00:00:00";
                    }
                
                }
                else if($value == 'lastLogin')
                {
                    if($data[$value] != '')
                    {
                        $arr[] = date('Y-m-d H:i:s', strtotime($data[$value]));
                    }
                    else
                    {
                        $arr[] = '';
                    }
                } 
                else if($value == 'log_date')
                {
                    $arr[] = date('d-m-Y', strtotime($data->$value));
                }
                else
                {
                    $arr[] = $data->$value;
                }            
            }

            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }

        fclose($csvFile);
        exit;
    }  
    public function editregistration(Request $request)
    {
        $title = 'Edit Registered User';
        $users = User::where('id', $request->id)->first();
        // dd($users);
        return view('admin.user.edit', compact('title'))->with('users', $users);
    } 
    public function editregistrationforsave(Request $request)
    {
        // dd($request->all());
        if ($request->name != '') {
            $update_interface_user = User::where('id', $request->interface_id)->update(['name' => $request->name, 'emp_code' => $request->emp_code,'email' => $request->email]);
        }

        return 1;
    }
    


}