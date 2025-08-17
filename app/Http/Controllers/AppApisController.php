<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\InterfaceUserRegistrations;
use App\Models\UserInterface;
use App\Models\Redeem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OnlineRegisterEmail;

class AppApisController extends Controller
{
    protected $now;
    
    public function __construct()
    {
        $this->now = Carbon::now();
    }

    public function login($username)
    {
        $user = DB::table('app_login')->where('username', $username)->first();

        
        if(!empty($user)) {
            
            $location=["Main Ballroom","Breakout 1","Breakout 2","Exhibitor 1","Exhibitor 2"];
            $response = ['status' => true, 'message' => 'User Found.', 'user'=>$user, 'location'=>$location];
        } else {
            $response = ['status' => false, 'message' => 'User Not Found.'];

        }
        echo json_encode($response);
        die;
    }

    public function search_user($search)
    {
        $user = DB::table('users')
            ->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search .'%')
                ->orWhere('phone', 'LIKE', '%' . $search .'%')
                ->orWhere('email', 'LIKE', '%' . $search .'%')
                ->orWhere('unique_code', 'LIKE', '%' . $search .'%')
                ->orWhere('emp_code', 'LIKE', '%' . $search .'%');
            })
            ->get();
        
        if(($user) && count($user) != 0) {
            $response = ['status' => true, 'message' => 'User Found.', 'data' => $user];
        } else {
            $response = ['status' => false, 'message' => 'User Not Found.'];

        }
        echo json_encode($response);
        die;
    }

    public function save_onsite_user($user_data)
    {
        $user_data = json_decode($user_data);

        $user = DB::table('users')->where('email', $user_data->email)->first();

        if($user)
        {
            $response = ['status' => false, 'message' => 'Email Already Registered.'];
        }
        else
        {
            $unique_code = 'IMP23'.$this->unique_code();
            $qrcode_path = $this->generateQr($unique_code);
            $eticket_path = $this->eticket($qrcode_path, $unique_code,strtoupper($user_data->name),strtoupper($user_data->company),$user_data->category);
        //$qr_path,$unique_code,$name,$company
            $data = array(

                'user_type' =>  $user_data->user_type,
                "category" => $user_data->category,
                "name" => $user_data->name,
                "email" => $user_data->email,
                "phone" => $user_data->phone,
                "company" => ucwords($user_data->company),
                "designation" => ucwords($user_data->designation),
                "unique_code" => $unique_code,
                "qrcode_path" => $qrcode_path,
                "eticket_path" => $eticket_path,
                'created_at' => $this->now,
                'updated_at' => $this->now,
                "status" => 1,
                "is_printed"=>1

            );

            $user_id = DB::table('users')->insertGetId($data);

            if(!empty($user_id)) {
                $body = [
                    'id' => $user_id,
                    'name' => $user_data->name,
                    'email' => $user_data->email,
                    'unique_code' => $unique_code,
                    'qrcode_path' => $qrcode_path,
                    "eticket_path" => $eticket_path,

                ];

                Mail::to($user_data->email)->send(new OnlineRegisterEmail($body));


                $response = ['status' => true, 'message' => 'Data saved successfully.', 'data' => $data];
            } else {
                $response = ['status' => false, 'message' => 'Not Found.'];
            }
        }


        echo json_encode($response);
        die;
    }

    public function entryzapping($unique_code,$location)
    {


            $userDetail =  DB::table('users')->where('unique_code', $unique_code)->where('status',1)->first();

            if($userDetail != '')
            {

                $data = [
                    'type'           =>$userDetail->user_type,
                    'location'       =>$location,
                    'unique_code'    =>$unique_code,
                    'created_at'     =>$this->now

                ];

                $result =  DB::table('entry_zapping')->insertGetId($data);


                $response = ['status' => true, 'message' => 'Allowed'];
            }
            else
            {
                $response = ['status' => false, 'message' => 'Not Allowed'];
            }



        echo json_encode($response);
        die;
    }

    // public function update(Request $request)
    // {
    //     $id = $request->route('id');
    //     $userData =  DB::table('users')->where('id', $id)->first();
    //     if(!empty($userData))
    //     {
    //         DB::table('users')->where('id', $id)->update(['is_printed' => 1, 'printed_at' => $this->now,]);

    //         $redeem = new Redeem();

    //         $data = [
    //             'user_id'       => $id,
    //             'created_at'    => $this->now,
    //             'updated_at'    => $this->now
    //         ];

    //         $result = $redeem->create($data);
    //         $userAttendee = DB::table('users')->where('id',$userData->id)->where('unique_code',$userData->unique_code)->get();
    //         $totalUserCount = 0;
    //         if(!$userAttendee->isEmpty()){
    //             foreach ($userAttendee as $key => $value) {
    //                 if($value->adult_1 != 'No'){
    //                    $totalUserCount += 1;
    //                 }

    //                 if($value->adult_2 != 'No'){
    //                    $totalUserCount += 1;
    //                 }

    //                 if($value->spouse != 'No'){
    //                    $totalUserCount += 1;
    //                 }

    //                 if($value->kid_1 != 'No'){
    //                    $totalUserCount += 1;
    //                 }

    //                 if($value->kid_2 != 'No'){
    //                    $totalUserCount += 1;
    //                 }
    //             }
    //         }
    //         $remainCount  = 0;
    //         $remainData   = [];
    //         if(!$userAttendee->isEmpty())
    //         {
    //             foreach ($userAttendee as $key => $valueRem)
    //             {
    //                 if($valueRem->is_adult_1 != 0)
    //                 {
    //                    $remainCount += 1;
    //                    $remainData['adult_1'] = $value->adult_1;
    //                 }

    //                 if($valueRem->is_adult_2 != 0){
    //                    $remainCount += 1;
    //                    $remainData['adult_2'] = $value->adult_2;
    //                 }

    //                 if($valueRem->spouse != 0){
    //                    $remainCount += 1;
    //                    $remainData['spouse'] = $value->spouse;
    //                 }

    //                 if($valueRem->is_kid_1 != 0){
    //                    $remainCount += 1;
    //                    $remainData['kid_1'] = $value->kid_1;
    //                 }

    //                 if($valueRem->is_kid_2 != 0){
    //                    $remainCount += 1;
    //                    $remainData['kid_2'] = $value->kid_2;
    //                 }
    //             }
    //         }
            
    //         $response = ['status' => true, 'message' => 'Redeem Successfully','total_member'=>$totalUserCount,'remaining_member'=>$remainCount, 'member_data' => $remainData];
    //     }
    //     else
    //     {
    //         $response = ['status' => false, 'message' => 'Incorrect User'];
    //     }

    //     // dd($response);
    // //    return $remainData

    //     echo json_encode($response);
    //     die;
    // }
    public function update(Request $request)
    {
        $id = $request->route('id');
        
        // Validate that ID is provided and is numeric
        if (!$id || !is_numeric($id)) {
            $response = ['status' => false, 'message' => 'Invalid user ID provided'];
            echo json_encode($response);
            die;
        }
        
        $userData = DB::table('users')->where('id', $id)->first();
        if(!empty($userData))
        {
            
            $username=$userData->name;
            // if($userData->adult_1!="No"){$adult1=$userData->is_adult_1;}else{$adult1=1;}
            // if($userData->adult_2!="No"){$adult2=$userData->is_adult_2;}else{$adult2=1;}
            // if($userData->spouse!="No"){$is_spouse=$userData->is_spouse;}else{$is_spouse=1;}
            // if($userData->kid_1!="No"){$is_kid1=$userData->is_kid_1;}else{$is_kid1=1;}
            // if($userData->kid_2!="No"){$is_kid2=$userData->is_kid_2;}else{$is_kid2=1;}
            // // $remaindata=$adult1+$adult2+$is_spouse+$is_kid1+$is_kid2;
           
            // // if($adult1!=1 && $adult2!=1 && $is_spouse!=1 && $is_kid1!=1 && $is_kid2!=1)
            // // {
            // //     $remaindata=$adult1+$adult2+$is_spouse+$is_kid1+$is_kid2;
            // // }
            // // dd($remaindata);
    
            DB::table('users')->where('id', $id)->update(['is_printed' => 1, 'printed_at' => $this->now,]);

            $redeem = new Redeem();

            $data = [
                'user_id'       => $id,
                'created_at'    => $this->now,
                'updated_at'    => $this->now
            ];

            $result = $redeem->create($data);
            $userAttendee = DB::table('users')
                ->select('id', 'name', 'adult_1', 'adult_2', 'spouse', 'kid_1', 'kid_2', 
                         'is_adult_1', 'is_adult_2', 'is_spouse', 'is_kid_1', 'is_kid_2')
                ->where('id',$userData->id)
                ->where('unique_code',$userData->unique_code)
                ->get();
            $totalUserCount = 0;
            if(!$userAttendee->isEmpty()){
                foreach ($userAttendee as $key => $value) {
                    if($value->adult_1 != 'No'){
                       $totalUserCount += 1;
                    }

                    if($value->adult_2 != 'No'){
                       $totalUserCount += 1;
                    }

                    if($value->spouse != 'No'){
                       $totalUserCount += 1;
                    }

                    if($value->kid_1 != 'No'){
                       $totalUserCount += 1;
                    }

                    if($value->kid_2 != 'No'){
                       $totalUserCount += 1;
                    }
                }
            }
            $remainCount  = 0;
            $remainData   = [];
            if(!$userAttendee->isEmpty()){
                foreach ($userAttendee as $key => $valueRem) {
                    
                    // if($valueRem->is_adult_1 != 0){
                    //    $remainCount += 1;
                                               if($valueRem->adult_1=="No")
                        {
                          $remainData[$key]['is_adult_1'] = '';
                        }
                        else{
                          if($valueRem->is_adult_1!=1)
                          {
                             $remainCount += 1;
                          }
                           $remainData[$key]['is_adult_1'] = $valueRem->is_adult_1;
                        }
                      
                    // }

                    // if($valueRem->is_adult_2 != 0){
                    //    $remainCount += 1;
                                               if($valueRem->adult_2=="No")
                        {
                          $remainData[$key]['is_adult_2'] = '';
                        }
                        else{
                          if($valueRem->is_adult_2!=1)
                          {
                             $remainCount += 1;
                          }
                          $remainData[$key]['is_adult_2'] = $valueRem->is_adult_2;
                        }
                    // }

                    // if($valueRem->is_spouse != 0){
                    //    $remainCount += 1;
                                               if($valueRem->spouse=="No")
                        {
                         $remainData[$key]['is_spouse'] = '';
                        }
                        else{
                         // 
                         if($valueRem->is_spouse!=1)
                         {
                             $remainCount += 1;
                         }
                         $remainData[$key]['is_spouse'] = $valueRem->is_spouse;
                        }
                    // }

                    // if($valueRem->is_kid_1 != 0){
                    //    $remainCount += 1;
                                               if($valueRem->kid_1=="No")
                        {
                          $remainData[$key]['is_kid_1'] = '';
                        }
                        else{
                         if($valueRem->is_kid_1!=1)
                         {
                             $remainCount += 1;
                         }
                          $remainData[$key]['is_kid_1'] = $valueRem->is_kid_1;
                        }
                      
                    // }

                    // if($valueRem->is_kid_2 != 0){
                    // 
                                               if($valueRem->kid_2=="No")
                        {
                          $remainData[$key]['is_kid_2'] = '';
                        }
                        else{
                         if($valueRem->is_kid_2!=1)
                         {
                             $remainCount += 1;   
                         }
                          $remainData[$key]['is_kid_2'] = $valueRem->is_kid_2;
                        }
                       
                    // }
                    
                }
            }
            
            $response = ['status' => true, 'message' => 'Redeem Successfully','total_member'=>$totalUserCount,'remaining_member'=>$remainCount, 'member_data' => $remainData,'username'=>$username];
        }
        else
        {
            $response = ['status' => false, 'message' => 'Incorrect User'];
        }

        echo json_encode($response);
        die;
    }
    public function getRemainingMembers($user_id)
{
    $remainingMembers = DB::table('users')
        ->select('id', 'is_adult_1', 'is_adult_2', 'spouse', 'is_kid_1', 'is_kid_2')
        ->where('user_id', $user_id) // Filter by the specific user_id
        ->where('status', 0)
        ->where(function ($query) {
            $query->where('is_adult_1', 0)
                  ->orWhere('is_adult_2', 0)
                  ->orWhere('spouse', 0)
                  ->orWhere('is_kid_1', 0)
                  ->orWhere('is_kid_2', 0);
        })
        ->get();

    return $remainingMembers;
}
    public function update_member($user_member_ids)
    {
        
        $ids = explode(",",$user_member_ids);
        $response = ['status' => false, 'message' => 'No id found.'];
        if(isset($ids) && !empty($ids)){
            foreach ($ids as $key => $id) {
                $data =  UserAttendance::where('id', $id)->first();
                if(!empty($data))
                {
                    UserAttendance::where('id', $id)->update(['is_attended' => 1, 'attended_at' => $this->now]);
                }
            }
            $response = ['status' => true, 'message' => 'Member added successfully'];
        }

        echo json_encode($response);
        die;
    }

    /*-------------------------------------------------------------------------------- common functions ---------------------------------------------------------------------------------*/
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

}
