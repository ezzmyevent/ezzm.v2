<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Interfaces;
use App\Models\User;
use App\Models\Redeem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Session, Config, DB,Storage , Log;
use App\Mail\UserRegistrationOrderSummaryEmail;
use App\Mail\OngroundUserEmail;
use App\Mail\BkInterfaceEmail;
use App\Mail\InterfaceMail;
use Illuminate\Http\Exceptions\HttpResponseException;
use Response;
use App\Http\Controllers\UserController;
use App\Http\Controllers\{EticketCreatorController,ExhibitorMbadgeController};
use App\Http\Controllers\Api\ThirdPartySharingController;
use App\Http\Controllers\WhatsappmsgController;
use App\Models\UserCategoryUpgrade;


class ZappingApiController extends Controller
{
    public function __construct()
    {
        $this->now = Carbon::now();
        $prefix_uniquecode = DB::table('events')->select('prefix_uniquecode')->where('status', 1)->first();
        $this->unique_code_prefix = $prefix_uniquecode->prefix_uniquecode;
        $this->eventId = 1;
    }

    public function zapping($location, $code)
    {
        $currentDateTime=Carbon::now();
        $inputs['unique_code'] = $code;
        $inputs['location'] = $location;

        $guestDetails=  User::where('unique_code',$inputs['unique_code'])->orWhere('emp_code', $inputs['unique_code'])->where('is_printed',1)->first();
        $kidArray = [];

        $result =DB::table('entry_zapping')->where('unique_code',$guestDetails->unique_code)->first();
        if(!empty($result)){

            $response = [
                'status' => false,
                'message' => "Allow one time zapping."

              ];
            return response()->json($response, 200);
        }

        if(!empty($guestDetails) && $guestDetails->status == 1)
        {
            if($guestDetails->kid_1 != null && $guestDetails->kid_1 != 'No' && $guestDetails->is_printed_kid_1 == 1)
            {
                $kidArray['kid_1'] = $guestDetails->kid_1;
            }
            if($guestDetails->kid_2 != null && $guestDetails->kid_2 != 'No' && $guestDetails->is_printed_kid_2 == 1)
            {
                $kidArray['kid_2'] = $guestDetails->kid_2;
            }
        }
        else if(!empty($guestDetails) && $guestDetails->status == 0)
        {
            $response = [
                'status' => false,
                'data'    => [],
                'message' => "Not Allowed - User Registration Pending"

              ];
            return response()->json($response, 200);
        }
        else{
              
                $response = [
                  'status' => false,
                  'data'    =>$guestDetails,
                  'message' => "Access Denied"

                ];
              return response()->json($response, 200);
            }
        if($guestDetails->category == 'Employee' && count($kidArray) > 0) {

            $zapp =$this->userEntryZapping($location,$guestDetails,$inputs);

            if($zapp == 1)
            {
                $kids = implode(',', $kidArray);
                
                $kids = str_replace('13-18', '', $kids);
                $kids = preg_replace('/,+/', ',', $kids);
                $kids = trim($kids, ',');

                $response = [
                    'status' => true,
                    'data'    => $guestDetails,
                    'message' => $kids. " - Allowed"
                ];
                return response()->json($response, 200);

            }
            else if ($zapp == 2) {
              $response  =  array('status' => false, 'message' => "Already Zapped.");
              return response()->json($response, 200);
          }else if ($zapp == 3) {
              $response  =  array('status' => false, 'message' => "Please Entry First.");
              return response()->json($response, 200);
          }else if ($zapp == 4) {
              $response  =  array('status' => false, 'message' => "Please Exit From Previous Location");
              return response()->json($response, 200);
          }  else {
              if($locations->without_exit_entry == 1)
              {
                  $response  =  array('status' => false, 'message' => "Not Allowed1.");
                  return response()->json($response, 200);
              }
              else{
                  $response  =  array('status' => false, 'message' => "Already Zapped");
                  return response()->json($response, 200);
              }

          }
        }
        else
        {
            $response = [
                'status' => false,
                'data'    => $guestDetails,
                'message' => "Kids not allow.",
            ];
            return response()->json($response, 200);
        }

    }

    public function sendErrorZapping($data,$message)
    {

    }

    
    // private function userZapping($location,$guestDetails,$inputs)
    // {
    //     $todayDate=$this->now;

    //     if($location->entry_type == 'S')
    //     {
    //         $getUser= DB::table('entry_zapping')->where('location',$location->location)
                   
    //                   ->where('unique_code',$guestDetails->unique_code)
    //                   ->whereDate('created_at',$todayDate)->first();

    //         DB::beginTransaction();
    //         if(empty($getUser))
    //         {
  
            

    //             $data = [
    //                 'type' => $guestDetails->user_type,
    //                 'location' => $location->location,
    //                 'unique_code' => $guestDetails->unique_code,
    //                 'category' => $guestDetails->category,
    //                 'zapping_type'=>$guestDetails->access_prefix,
    //                 'appuser' => $inputs['appuser'],
    //                 'app_mobile_no' => $inputs['app_mobile_no'],
    //                 'created_at' => $this->now,
    //             ];

    //             $result =DB::table('entry_zapping')->insert($data);
    //             DB::commit();
    //             $responseData=1;
    //         }
    //         else
    //         {
    //             DB::rollBack();
    //             $responseData=0;
    //         }
    //     }
    //     else
    //     {

    //         if($location->date_check == 'Y')
    //         {
    //             $getUser= DB::table('entry_zapping')->where('location',$location->location)
             
    //             ->where('unique_code',$guestDetails->unique_code)
    //             ->whereDate('created_at',$todayDate)->first();

    //             DB::beginTransaction();
    //             if(empty($getUser))
    //             {

    //                 $data = [
    //                     'type' => $guestDetails->user_type,
    //                     'location' => $location->location,
    //                     'unique_code' => $guestDetails->unique_code,
    //                     'category' => $guestDetails->category,
    //                     'zapping_type'=>$guestDetails->access_prefix,
    //                     'appuser' => $inputs['appuser'],
    //                     'app_mobile_no' => $inputs['app_mobile_no'],
    //                     'created_at' => $this->now,
    //                 ];
    
    //                 $result =DB::table('entry_zapping')->insert($data);
    //                 DB::commit();
    //                 $responseData=1;
    //             }
    //             else
    //             {
    //                 DB::rollBack();
    //                 $responseData=0;
    //             }
    //         }
    //         else
    //         {
    //             DB::beginTransaction();

    //             $data = [
    //                 'type' => $guestDetails->user_type,
    //                 'location' => $location->location,
    //                 'unique_code' => $guestDetails->unique_code,
    //                 'category' => $guestDetails->category,
    //                 'zapping_type'=>$guestDetails->access_prefix,
    //                 'appuser' => $inputs['appuser'],
    //                 'app_mobile_no' => $inputs['app_mobile_no'],
    //                 'created_at' => $this->now,
    //             ];

    //             $result =DB::table('entry_zapping')->insert($data);
    //             DB::commit();
    //             $responseData=1;
    //         }
    //     }    
        
    //     return $responseData;

    // }




    private function userEntryZapping($location,$guestDetails,$inputs)
    {

        $todayDate=$this->now;
        Log::info('entry code work');
        DB::beginTransaction();
        $data = [
            'type' => $guestDetails->user_type,
            'location' => $location,
            'unique_code' => $guestDetails->unique_code,
            'email_send' => $guestDetails->email_send,
            'created_at' => $this->now,
        ];

        $result =DB::table('entry_zapping')->insert($data);
        DB::commit();
        $responseData=1;

        return $responseData;

    }

}