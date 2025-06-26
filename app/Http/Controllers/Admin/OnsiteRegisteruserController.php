<?php
    
namespace App\Http\Controllers\Admin;
    
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Storage, Validator, Config;
    
class OnsiteRegisteruserController extends Controller
{

        public function __construct() {
        $this->now = Carbon::now();
    }
    
    public function index(Request $request)
    {
        $title = 'Onsite Registered Users';

         if( !empty( $request->input(['post_type'])) )
        {
                $pagination = 'no';
                $users = DB::table('onground_registrations')->select("*")
                    ->when($request->input('name'), function ($query) use ($request) {
                       $query->where('name', 'LIKE', '%' . $request->name .'%');
                    })
                    ->when($request->input('email'), function ($query) use ($request) {
                       $query->where('email', 'LIKE', '%' . $request->email .'%');
                    })
                    ->when($request->input('phone'), function ($query) use ($request) {
                        $query->where('phone', 'LIKE', '%' . $request->phone .'%');
                    })
                    ->when($request->input('qr'), function ($query) use ($request) {
                        $query->where('unique_code',$request->qr);
                    })
                    //->paginate(5)
                    ->where('status',1)
                    ->get();

        } else {

            $users = DB::table('onground_registrations')->where('status',1)->paginate(50);
            $pagination = 'yes';

        }

        return View('admin.onsiteuser.index', compact('title','users','pagination'));
    }

    public function getrates(Request $request)
    {
        $ticket_price = DB::table('event_logs')->where('module_name', $request->ticket_category)->first();
        
        $day_count = count($request->dates);

        if($day_count == 3 && $request->ticket_category == 'Symposium - Student') {
            $payble_amount = 3000;
        }else if($day_count == 3 && $request->ticket_category == 'Symposium') {
            $payble_amount = 6000;
        } else {
            $payble_amount = $day_count * $ticket_price->data;
        }

        if(!empty($payble_amount)) {
            $response = ['status' => true, 'message' => 'Data Found.', 'payble_amount' => $payble_amount];
        } else {
            $response = ['status' => false, 'message' => 'Not Found.'];

        }
        echo json_encode($response);
        die;
    }

    public function addonsiteusers(Request $request)
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
        
        $unique_code = 'ID22'.$this->unique_code();
        if($request->ticket_category == 'Visitors Entry'){
            $qrcode_path = $this->generateQr($unique_code, 'General');
        } else {
            $qrcode_path = $this->generateQr($unique_code, 'Symposium');
        }

        $eticket_path = $this->eticket($qrcode_path, $unique_code);
        $festival_dates = implode(',', $request->festival_dates);

        $data = array(
            'festival_dates' => $festival_dates,
            'ticket_category' =>  $request->ticket_category,
            "name" => $request->name,
            "phone" => $request->phone,
            "country_code" => '+91',
            "email" => $request->email,
            "state" => $request->state,
            "city" => $request->city,
            "gender" => $request->gender,
            "unique_code" => $unique_code,
            "qrcode_path" => $qrcode_path,
            "eticket_path" => $eticket_path,
            'created_at' => $this->now,
            'updated_at' => $this->now,
            "payment_staus" => 1,
            "payment_method" => $request->paymenttype,
            "amount" => $request->payable_amount,
            "sent_email" => 1,
            "status" => 1
        );

        $user_id = DB::table('onground_registrations')->insertGetId($data);
        
        if(!empty($user_id)) {
            $body = [
                'id' => $user_id,
                'name' => $request->name,
                'email' => $request->email,
                'qr_code' => $unique_code,
                'qr_path' => $qrcode_path,
                'dates' => implode(',', $request->festival_dates),
            ];
            //Mail::to($request->email)->send(new RegisterEmail($body));
            //$this->registration_confirm_whatsapp($request->name,$request->phone,$eticket_path,implode(',', $request->festival_dates));
        
            $response = ['status' => true, 'message' => 'Data saved successfully.', 'user_id' => $user_id];
        } else {
            $response = ['status' => false, 'message' => 'Not Found.'];
        }
        echo json_encode($response);
        die;
    }

    public function registration_confirm_whatsapp($name,$mobile,$eticketpath,$date)
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
                        "name": "visitor_paid_registration_confimation_emailer_id22",
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

    public function exportOnsiteData()
    {
        $result = DB::table('onground_registrations')->get();

        $filename = "Data Reports.csv";

        $headerRow = ['Name', 'Email', 'Phone Number', 'Festival Dates', 'Unique Code', 'Created'];
        

        $delimiter = ',';
        $enclosure = '"';
        $csvFile = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        fputcsv($csvFile,$headerRow, $delimiter, $enclosure);

        foreach($result as $data)
        {
            $arr = [
                $data->name,
                $data->email,
                '+91 '.$data->phone,
                $data->festival_dates.' May 2022',
                $data->unique_code,
                date('Y-m-d H:i:s', strtotime($data->created_at))
            ];

            fputcsv($csvFile, $arr, $delimiter, $enclosure);
        }

        fclose($csvFile);
    }

    /*-------------------------------------------------------------------------------- common functions ---------------------------------------------------------------------------------*/
    public function unique_code()
    {
        $unique_code = DB::table('online_registration_unique_codes')->where('is_used', 0)->first();
        DB::table('online_registration_unique_codes')->where('id', $unique_code->id)->update(['is_used' => 1, 'modified' => Carbon::now()]);
        return $unique_code->unique_code;
        
    }

    public function generateQr($unique_code, $category)
    {
        $arr=array("$unique_code","$category");

        //$qr_save = QrCode::format('png')->generate(json_encode($arr), 'public/qrcodes/'.$unique_code.'.png','image/png');

        $document = QrCode::format('png')->margin(2)->size(150)->backgroundColor(255, 255, 255)->generate(json_encode($arr),'public/qrcodes/'.$unique_code.'.png','image/png');
        $document_path = 'public/qrcodes/'.$unique_code.'.png'; 
        //dd($document_path);
        // $document_path = Storage::disk('s3')->put($upload_name, $document, 'public');
        // $document_path = Storage::disk('s3')->url($upload_name);
        
        return $document_path;

    }

    public function eticket($qr_path, $unique_code)
    {
        $new = imagecreatefrompng($qr_path);
        $master = imagecreatefrompng('public/ID22.png');
                            
        imagealphablending($master, false);
        imagecopymerge($master, $new, 150, 510, 0, 0, 150, 150, 100);
        // imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct )
        
        $white = imagecolorallocate($master, 0, 0, 0);
        $font = realpath('public/arial.ttf');
        imagettftext($master, 20, 0, 150, 690, $white, $font, $unique_code);

        // header('Content-Type: image/png');
        $masterImg= imagepng($master,'public/eticket/'.$unique_code.".png");

        if($masterImg)
        {
            $upload_name= "public/eticket/".$unique_code.".png";
           // $eticketpath = Storage::disk('s3')->put($upload_name, file_get_contents('public/eticket/'.$unique_code.'.png'), 'public');
           // $eticketpath = Storage::disk('s3')->url($upload_name);
           // unlink('public/eticket/'.$unique_code.'.png');

        }
        return $upload_name;
    }

    public function qrcode_user($unique_code, $category)
    {
        $arr=array("$unique_code","$category");
        $document = QrCode::format('png')->margin(2)->size(150)->backgroundColor(255, 255, 255)->generate(json_encode($arr));
        return View('admin.onsiteuser.qrcode_user', compact('document','unique_code','category'));
        //dd($document);
        //return $document;
    }

}