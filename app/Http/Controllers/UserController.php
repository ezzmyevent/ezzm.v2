<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use DB, Storage, Validator, Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\OnlineRegisterEmail;
use App\Mail\SendOTPMail;
use App\Http\Controllers\WhatsappmsgController;
class UserController extends Controller
{
    /**
        * Instantiate a new controller instance.
        *
        * @return void
    */

    public function __construct() 
    {
        $this->unicode_prefix = 'IMP23';
        session_start();
        $this->now = Carbon::now();
    }

    public function index() 
    {
        session_destroy();
        return view('user.index');
    }

    

    public function loginSelectUser($user_id)
    {
        $user_id = base64_decode($user_id);
        $user_details = User::where('id', $user_id)->first();
        
        return view('user.loginuserselect')->with('user_details', $user_details);
    }
    public function eventStatus($user_id)
    {
        return view('user.event-status',compact('user_id'));
    }
    public function eventSaveStatus(Request $request)
    {
        
        if($request->status == 1)
        {
            return response()->json(['message' => 'Yes event status']);
        }
        else
        {
            User::where('id',base64_decode(Session::get('user')))->update(['event_status'=>2]);
            return response()->json(['message' => 'No event status']);
        }
        
    }
    public function thanks(){
        return view('user.thanks');
    }
    public function attendeesUser($user_id)
    {
        $user_id = base64_decode($user_id);
        $user_details = User::where('id', $user_id)->first();
        return view('user.attendees-user')->with('user_details', $user_details);
    }
    public function login(Request $request){
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ], [
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
            ]);
    
            if ($validator->passes())
            {
                $user = User::where('email', $request->email)->first();
                
                if (!empty($user))
                {
                    Session::forget('user');
                    $otp = $this->generateOTP();
                    $user->otp = $otp;
                    $user->otp_expires_at = now()->addMinutes(5);
    
                    $user->save();
                    Session::put('otp', $otp);
                    Session::put('user', base64_encode($user->id));
                    // $body = [
                    //     'name' => $user->name,
                    //     'otp' => $otp,
                    // ];
                    // Mail::to($user->email)->send(new SendOTPMail($body));
                    DB::table('users')->where('id', $user->id)->update(['otp_status' => 0]);
                    return response()->json(['type' => 'Success', 'message' => 'User found successfully', 'user_id' => base64_encode($user->id)]);
                } else {
                    return response()->json(['error' => ['Invalid email']]);
                }
            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }
    
        return view('user.login');
    }

    public function verifyOTP(Request $request){
        $storedOTP = Session::get('otp');
        $masterOTP = DB::table('master_otp')->select('otp_code')->first()->otp_code;

        if ($request->otp == $storedOTP || $request->otp == $masterOTP) {
            $user = User::find(base64_decode(Session::get('user')));
            $attend = $user->event_status;
            $updateStatus = $user->update_status;
            if ($user->otp_expires_at >= now()) {
                // OTP is correct and not expired
                Session::forget('otp'); // Clear the OTP from the session

                return response()->json(['message' => 'OTP verified successfully','attend' => $attend,'updateStatus'=>$updateStatus]);
            } else {
                return response()->json(['error' => 'OTP has expired.']);
            }
        } else {
            return response()->json(['error' => 'Invalid OTP']);
        }
    }
   
    private function generateOTP(){
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function resendOTP(Request $request){
        Session::forget('otp');
        $user = User::find(base64_decode(Session::get('user')));
        if ($user) {
                $otp = $this->generateOTP();
                Session::put('otp', $otp);
                $user->otp = $otp;
                $user->otp_expires_at = now()->addMinutes(5);
                $user->save();
                // $body = [
                //     'name' => $user->name,
                //     'otp' => $otp,
                // ];
                // Mail::to($user->email)->send(new SendOTPMail($body));
                DB::table('users')->where('id', $user->id)->update(['otp_status' => 0]);
                return response()->json(['message' => 'OTP resent successfully']);
            // } else {
            //     return response()->json(['error' => 'OTP has expired.']);
            // }
        } else {
            return response()->json(['error' => 'User not found.']);
        }
    }

    public function saveActivities(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
        ],[
            'mobile.required' => 'Mobile is required.',
        ]);

        if ($validator->passes()) {
            
            $userData        = DB::table('users')->where('id',$request->user_id)->first();
            // $unique_code = $this->unicode_prefix.$this->unique_code();
            // $qrcode_path = $this->generateQr($unique_code);
            // $eticket_path = $this->eticket($qrcode_path,$unique_code,strtoupper($userData->name),strtoupper($userData->emp_code),$userData->category);
            // //dd($eticket_path)

            $user_id         = $request->user_id;
            $userInformation = [   
                'phone'=> $request->mobile,
                'slot'         => $request->slot,
                'adult_1'      => $request->adult_1,
                'adult_2'      => $request->adult_2,
                'spouse'       => $request->spouse,
                'kid_1'        => $request->kid_1,
                'kid_2'        => $request->kid_2,
                'created_at'   => $this->now,
                'updated_at'   => $this->now,
                'attendance_ballroom'   => 2,
                'country_code'   => $request->country_code,
                'guest1_name'        => $request->guest1_name,
                'guest2_name'        => $request->guest2_name,
                'guest3_name'        => $request->guest3_name,
                'kid1_name'        => $request->kid1_name,
                'kid2_name'        => $request->kid2_name,
                'details_updated'   => 1,
                'event_status'   => 1,

            ];
            
            $user_activity = DB::table('users')->where('id',$request->user_id)->update($userInformation);
           
            // if(!empty($userData)) {
            //         if ($userData->email != '') {
            //         $body = [
            //             'name' => $userData->name,
            //             'email' => $userData->email,
            //             'qrcode_path' => $qrcode_path,
            //             'eticket_path' => $eticket_path,
            //         ];
            //         Mail::to($userData->email)->send(new OnlineRegisterEmail($body));
            //         User::where('id',$userData->id)->update(['email_send' =>1]);   
            //     }
            //     if(!empty($request->mobile)){
            //         (new WhatsappmsgController)->confirmation_msg($request->country_code,$request->mobile,ucwords($userData->name),$eticket_path,
            //             $userData->id); 
            //         User::where('id',$userData->id)->update(['send_whatsapp' =>1]);    
            //     }
            // }
            return response()->json(['type'=>'Success', 'message'=> 'Activities updated successfully.']);
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    public function saveAttendees(Request $request)
    {   
        


        $guest1_name = null;
        $guest2_name = null;
        $guest3_name = null;
        $kid1_name = null;
        $kid2_name = null;

        $rules = [
            'mobile' => 'required',
        ];
        
        $messages = [
            'mobile.required' => 'Mobile is required.',
        ];
        
        if ($request->adult_1 != 'No') {
            $guest1_name = $request->guest1_name;
            $rules['guest1_name'] = 'required';
            $messages['guest1_name.required'] = 'Adult 1 name is required.';
        }
        
        if ($request->adult_2 != 'No') {
            $guest2_name = $request->guest2_name;
            $rules['guest2_name'] = 'required';
            $messages['guest2_name.required'] = 'Adult 2 name is required.';
        }
        
        if ($request->spouse != 'No') {
            $guest3_name = $request->guest3_name;
            $rules['guest3_name'] = 'required';
            $messages['guest3_name.required'] = 'Adult 3 name is required.';
        }
        
        if ($request->kid_1 != 'No') {
            $kid1_name = $request->kid1_name;
            $rules['kid1_name'] = 'required';
            $messages['kid1_name.required'] = 'Kid 1 name is required.';
        }
        
        if ($request->kid_2 != 'No') {
            $kid2_name = $request->kid2_name;
            $rules['kid2_name'] = 'required';
            $messages['kid2_name.required'] = 'Kid 2 name is required.';
        }
        
        $validator = Validator::make($request->all(), $rules, $messages);
        

        if ($validator->passes()) {
            

            $adultcount = 0;    
            $adultcount = $request->adult_1 != null && $request->adult_1 != 'No' ? 1 :0;
            $adultcount += $request->adult_2 != null && $request->adult_2 != 'No' ? 1 :0;
            $adultcount += $request->spouse != null && $request->spouse != 'No' ? 1 :0;
    
    
            $kids = 0;    
            
            $kids = $request->kid_1 != null && $request->kid_1 != 'No' ?  1 :0;
            $kids += $request->kid_2 != null && $request->kid_2 != 'No' ? 1 :0;


            $userData  = DB::table('users')->where('id',$request->user_id)->first();
            if(!empty($userData->unique_code))
            {
                $unique_code = $userData->unique_code;
            }
            else
            {
                $unique_code = $this->unicode_prefix.$this->unique_code();
            }
            $qrcode_path = $this->generateQr($unique_code);
            $eticket_path = $this->eticket($qrcode_path,$unique_code,strtoupper($userData->name),strtoupper($userData->emp_code),$userData->category,$adultcount,$kids);
            $user_id         = $request->user_id;
            $userInformation = [ 
                'status'       => 1,
                'unique_code'  => $unique_code,
                'qrcode_path'  => $qrcode_path,
                'eticket_path' => $eticket_path,
                'phone'=> $request->mobile,
                'slot'         => $request->slot,
                'adult_1'      => $request->adult_1,
                'adult_2'      => $request->adult_2,
                'spouse'       => $request->spouse,
                'kid_1'        => $request->kid_1,
                'kid_2'        => $request->kid_2,
                'created_at'   => $this->now,
                'updated_at'   => $this->now,
                'attendance_ballroom'   => 2,
                'country_code'   => $request->country_code,
                'guest1_name'        => $guest1_name,
                'guest2_name'        => $guest2_name,
                'guest3_name'        => $guest3_name,
                'kid1_name'        => $kid1_name,
                'kid2_name'        => $kid2_name,
                'details_updated'   => 1,
                'attendees'        => 1,
                'event_status'        => 1,
                'update_status'        => $userData->update_status+1,

            ];
            
            $user_activity = DB::table('users')->where('id',$request->user_id)->update($userInformation);
           
            if(!empty($userData)) {
                    if ($userData->email != '') {
                    User::where('id',$userData->id)->update(['email_send' =>0]);   
                }
                if(!empty($request->mobile)){
                    User::where('id',$userData->id)->update(['send_whatsapp' =>0]);    
                }
            }
            return response()->json(['type'=>'Success', 'message'=> 'Activities updated successfully.']);
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    public function thanksActivity()
    {
        return view('user.thanks_activity');
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


    function checkAvailSlots(Request $request){
        $formData = $request->all();
        $slotCount = 0;
        // $formData['slot']
        $slot=1;
        if(!empty($slot)){
            $userData = DB::table('users')->where('slot',$formData['slot'])->where('date',$formData['date'])->get();
            if(!$userData->isEmpty()){
                foreach ($userData as $key => $value) {
                    if($value->adult_1 != 'No'){
                       $slotCount += 1;
                    }

                    if($value->adult_2 != 'No'){
                       $slotCount += 1;
                    }

                    if($value->spouse != 'No'){
                       $slotCount += 1;
                    }

                    if($value->kid_1 != 'No'){
                       $slotCount += 1;
                    }

                    if($value->kid_2 != 'No'){
                       $slotCount += 1;
                    }
                }
            }
            if($slotCount >= 895){
                return response()->json(['type'=>'error']);
            }else{
                return response()->json(['type'=>'success']);
            }
        }else{
            return response()->json(['type'=>'empty']);
        }
        
    }
    public function getmbadge()
    {
        session_destroy();
        return view('user.getmbadge');
    }
    public function findmbadge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required'
        ], [
            'search.required' => 'Please enter email or phone or uniquecode.',
        ]);

        if ($validator->passes()) {
            $userData = User::where('status', 1)
                ->where('email',$request->search)
                ->select('name', 'email', 'phone', 'eticket_path', 'unique_code', 'status')
                ->first();
            if(empty($userData))
                {
                    $userData = User::where('status', 1)
                    ->where('phone',$request->search)
                    ->select('name', 'email', 'phone', 'eticket_path', 'unique_code', 'status')
                    ->first();
                }

            if (!empty($userData->eticket_path)) {
                return response()->json(['type' => 'success', 'data' => $userData->eticket_path, 'message' => 'Data found.']);
            } else {
                return response()->json(['type' => 'error', 'data' => [], 'message' => 'Data not found.']);
            }
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function mbadgedownload(Request $request)
    {
        $mbadge = $request->query()['mbadge'];

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . basename($mbadge));
        header("Content-Type: image/jpeg");

        return readfile($mbadge);
    }

}
