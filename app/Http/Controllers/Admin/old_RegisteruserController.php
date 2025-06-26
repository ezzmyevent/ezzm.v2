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

class RegisteruserController extends Controller
{

    public function __construct() {
        $this->now = Carbon::now();
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
                            $query->orWhere('name', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('email', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('phone', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('company', 'LIKE', '%' . $request->search .'%');
                            $query->orWhere('unique_code', 'LIKE', '%' . $request->search .'%');

                        })->where('user_type','online')
                        ->get();


        } else {

            $users = User::where('user_type','online')->paginate(25);
            $pagination = 'yes';

        }

        return View('admin.user.index', compact('title','users','pagination','search'));
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

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            'company' => 'required',
            'designation' => 'required',
            'status' => 'required'
        ],[
            'category.required' => 'Category is required.',
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'company.required' => 'Company is required.',
            'designation.required' => 'Designation is required.',
            'status.required' => 'Status is required.',
        ]);

        if ($validator->passes()) {
            $users = new User();
            
            $unique_code = 'WM22'.$this->unique_code();
            $qrcode_path = $this->generateQr($unique_code);
            $eticket_path = $this->eticket($qrcode_path,$unique_code,strtoupper($request->name),strtoupper($request->company),$request->category);

            $data = [
                'user_type' => 'online',
                'category' => $request->category,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company,
                'designation' => $request->designation,
                'unique_code' => $unique_code,
                'qrcode_path' => $qrcode_path,
                'eticket_path' => $eticket_path,
                'status' => $request->status,
                'created_at' => $this->now,
                'updated_at' => $this->now,
            ];

            $user_submit = $users->create($data);
            if(!empty($user_submit)) {
                $body = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'qrcode_path' => $qrcode_path,
                    'eticket_path' => $eticket_path,
                ];
                Mail::to($request->email)->send(new OnlineRegisterEmail($body));

            }
            //return true;

        } else {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
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


    public function Feedback_OLD(Request $request)
    {
        $title = 'Feedback';
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


        }
        else
        {
            $users = DB::table('feedback')->join('users', 'users.id', '=', 'feedback.user_id')->paginate(25);
            $pagination = 'yes';
        }

        return View('admin.user.feedback', compact('title','users','pagination','search'));
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

    public function generateQr($unique_code)
    {
        
        $document = QrCode::format('png')->margin(2)->size(150)->backgroundColor(255, 255, 255)->generate($unique_code);
        
        $upload_name= "Smart-Reg/Watermark2022/qrcodes/".$unique_code.".png";
        $document_path = Storage::disk('s3')->put($upload_name, $document, 'public');
        $document_path = Storage::disk('s3')->url($upload_name);
    
        return $document_path;
    }


    function ImageTTFCenter($image, $text, $font, $size, $angle = 0)
    {
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


    public function eticket($qr_path,$unique_code,$name,$company,$category)
    {

        $new = imagecreatefrompng($qr_path);
        if($category == 'PARTNER')
        {
            $master = imagecreatefrompng('public/partner.png');
        }
        else if($category == 'EMPLOYEE')
        {
            $master = imagecreatefrompng('public/employee.png');
        }
        else if($category == 'SPEAKER')
        {
            $master = imagecreatefrompng('public/speaker.png');
        }
       else{
           $master = imagecreatefrompng('public/delegate.png');
        }

                            
      //  imagealphablending($master, false);

        imagecopymerge($master, $new, 187, 450, 0, 0, 150, 150, 100);
        // imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct )
        
        $white = imagecolorallocate($master, 0, 0, 0);
        $font = realpath('public/arial.ttf');
      //  imagettftext($master, 20, 0, 150, 690, $white, $font, $unique_code);

        //Unique Code Print ============================================================================================================================
        $unique_code_font_size = 11;

        list($x, $y) = $this->ImageTTFCenter($master, $unique_code, $font, $unique_code_font_size);
        imagettftext($master, $unique_code_font_size, 0, $x, $y+230, $white, $font, $unique_code);

        //Name Print ===================================================================================================================================
        $nameLen = strlen($name);

        if($nameLen > 25) {
            $name_font_size = 12;
        }
        else if($nameLen > 18) {
            $name_font_size = 20;
        }
        else {
            $name_font_size = 23;
        }

        list($x, $y) = $this->ImageTTFCenter($master, $name, $font, $name_font_size);
        imagettftext($master, $name_font_size, 0, $x, 390, $white, $font, $name);

        //Company Print ===============================================================================================================================
        $companyLen = strlen($company);

        if($companyLen < 25) {
            $company_font_size = 15;
        }
        if($companyLen > 35) {
            $company_font_size = 9;
        }
        else {
            $company_font_size = 12;
        }

        list($x, $y) = $this->ImageTTFCenter($master, $company, $font, $company_font_size);
        imagettftext($master, $company_font_size, 0, $x, 420, $white, $font, $company);

        // header('Content-Type: image/png');
        $masterImg= imagepng($master,'public/eticket/'.$unique_code.".png");

        if($masterImg)
        {
            $upload_name= "Smart-Reg/Watermark2022/eticket/".$unique_code.".png";
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

    public function sampleExcel()
    {
        $filename = " samplecsv.csv";

        $headerRow = [
            'Employee Code',
            'Name',
            'Lead Name',
            'Date'
        ];
        
        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);
        fclose($csvFile);
    }

    public function uploadcsv(Request $request)
    {
        if(!empty($request->file)) {
            $date = date('Y-m-d H:i:s');    
            $target_file = $_FILES["file"]["tmp_name"];
            $csvFile = fopen($target_file, 'r');
            $i = 0;
            while (($row = fgetcsv($csvFile)) !== FALSE) {
               $user_exist = User::where('emp_code', $row[0])->count();

                if($i > 0 && $user_exist == 0) {

                    $data_array = [
                        'user_type'  => 'online',
                        'emp_code'   => trim($row[0]),
                        'name'       => trim($row[1]),
                        'lead_name'  => trim($row[2]),
                        'date'       => trim($row[3]),
                        'email'      => trim($row[4]),
                        'status'     => 0,
                        'created_at' => $this->now,
                        'updated_at' => $this->now,
                    ];

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
        $result = User::where('status',1)->where('user_type','online')->select('name','email','company','category','designation','unique_code','attendance_ballroom','attendance_lunch','created_at')->where('is_printed',1)->get();
        $filename = "Pre_Registered_User_Reports.csv";
        
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

    public function exportUsersAll()
    {
        $result = User::where('status',1)->where('user_type','online')->select('name','email','company','category','designation','unique_code','attendance_ballroom','attendance_lunch','created_at')->get();
        $filename = "Pre_Registered_User_Reports_All.csv";
        
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

    public function onspotExportUsers()
    {
        $result = User::where('status',1)->where('user_type','onsite')->select('name','email','company','category','designation','unique_code','attendance_ballroom','attendance_lunch','created_at')->where('is_printed',1)->get();
        $filename = "Onspot_Registered_User_Reports.csv";
        
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

//Naveen Views
    public function coupon()
    {
        return view('admin.user.coupon');
    }
    public function sales_report()
    {
        return view('admin.user.sales-report');
    }
    public function ticket_type_detail()
    {
        return view('admin.user.ticket-type-detail');
    }
    public function form()
    {
        return view('admin.user.form');
    } 
    public function attendee_enquiries()
    {
        return view('admin.user.attendee-enquiries');
    }
    public function email_builder()
    {
        return view('admin.user.email-builder');
    }
    public function edit_email()
    {
        return view('admin.user.edit-email');
    }

}