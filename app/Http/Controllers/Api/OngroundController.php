<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;
use App\Models\Interfaces;
use App\Models\User;
use App\Models\Redeem;
use App\Models\Ticket;
use App\Models\Guest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Session, Config, DB, Storage;
use App\Mail\UserRegistrationOrderSummaryEmail;
use App\Mail\OngroundUserEmail;
use App\Mail\BkInterfaceEmail;
use App\Mail\InterfaceMail;

use Response;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EticketCreatorController;
use App\Http\Controllers\Api\ThirdPartySharingController;
use App\Http\Controllers\WhatsappmsgController;
use App\Models\UserCategoryUpgrade;

// for mail service
// use App\Models\MailTemplate;
// use App\Services\EmailService;
// use App\Services\EmailHelperService;
// use App\Models\CustomShortCode;
// use App\Models\{Order, Event};

class OngroundController extends Controller
{
    public function __construct()
    {
        $this->now = Carbon::now();
        $this->unicode_prefix = 'IMP23';
    }

    /* login */
    public function login($username)
    {
        // $username = $request->input('username');
        $user = DB::table('app_login')->where('username', $username)->first();
        // $printingCategory = array(
        //     array("key" => "Attendee", "value" => "Attendee")
        // );

        if ($user->category == 'Zapping') {
            $zapping_locations = DB::table('entry_zapping')->select('location')->pluck('location')->toArray();
            $entry = ["Entry"];
            $response_data = ['use_data' => $user, 'zapping_locations' => $entry];
        } else {
            
            $onspotCategories = Ticket::Select('id','name','category')->where('status', 1)->get();
            $response_data = ['use_data' => $user, 'categories' => $onspotCategories];
        }

        if (!empty($user)) {

               $response = ['status' => true, 'message' => 'User Found.',  'data' => $response_data];
        } else {
            $response = ['status' => false, 'message' => 'User Not Found.'];
        }
        echo json_encode($response);
        die;
    }


    public function search($key)
    {

        $searchData = $key;
        $search_data = [];

        $userdata = User::where('status', '!=', 0)
            ->where(function ($q) use ($searchData) {
                $q->where('users.name', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.phone', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.kid1_name', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.kid2_name', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.guest1_name', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.guest2_name', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.guest3_name', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.adult_1', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.adult_2', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.spouse', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.kid_1', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.kid_2', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.unique_code', 'LIKE', '%' . $searchData . '%')
                    ->orWhere('users.emp_code', 'LIKE', '%' . $searchData . '%');
            })->get();

        $array_data = json_decode($userdata, true);
        $filtered_data = [];
        $total = 0;

        foreach ($array_data as $item) {
            $members = [
                [
                    "relation" => "self",
                    "name"     => isset($item['name']) ? $item['name'] : "Raju K S",
                    "is_printed" => isset($item['is_printed']) ? $item['is_printed'] : 0,
                ]
            ];
            if (isset($item['is_printed_adult_1'])  && !empty($item['adult_1']) && $item['adult_1'] != 'No') {
                $members[] = [
                    "relation" => $item['adult_1'],
                    "name"     => $item['guest1_name'],
                    "is_printed" => $item['is_printed_adult_1']
                ];
                $total = 1;
            }

           


            if (isset($item['is_printed_adult_2']) && !empty($item['adult_2']) && $item['adult_2'] != 'No') {
                $members[] = [
                    "relation" => $item['adult_2'],
                    "name"     => $item['guest2_name'],
                    "is_printed" => $item['is_printed_adult_2']
                ];
                $total = $total+1;
            }
           
            if (isset($item['is_printed_adult_3']) && !empty($item['spouse']) && $item['spouse'] != 'No') {
                $members[] = [
                    "relation" => $item['spouse'],
                    "name"     => $item['guest3_name'],
                    "is_printed" => $item['is_printed_adult_3']
                ];
                $total = $total+1;
            }

           
            $renaminkid = [];
            $kidtotal = 0;
            if (isset($item['is_printed_kid_1'])  && !empty($item['kid_1']) && $item['kid_1'] != 'No') {
                $members[] = [
                    "relation" => $item['kid_1'],
                    "name"     => $item['kid1_name'],
                    "is_printed" => $item['is_printed_kid_1']
                ];
            }

            if ($item['kid_1'] == 'No' || $item['kid_1'] == null)  {
                $renaminkid[] = [
                    "relation" => 'kid_1',
                    "name"     => "",
                    "is_printed" => $item['is_printed_kid_1']
                ];
            }


            if (isset($item['is_printed_kid_2']) && !empty($item['kid_2']) && $item['kid_2'] != 'No') {
                $members[] = [
                    "relation" => $item['kid_2'],
                    "name"     => $item['kid2_name'],
                    "is_printed" => $item['is_printed_kid_2']
                ];
               
            }

            if ($item['kid_2'] == 'No' || $item['kid_2'] == null) {
                $renaminkid[] = [
                    "relation" => 'kid_2',
                    "name"     => "",
                    "is_printed" => $item['is_printed_kid_2']
                ];
            }
            
            if (!empty($item['kid_1']) && $item['kid_1'] != 'No') {
                $kidtotal = 1;
                
            }
            if (!empty($item['kid_2'])  && $item['kid_2'] != 'No') {
                $kidtotal = $kidtotal+1;
                
            }

            $spouse =DB::table('users')->where('id',$item['id'])
            ->selectRaw("
                SUM(
                    (adult_1 = 'Spouse') + (adult_2 = 'Spouse') + (spouse = 'Spouse')
                ) as total_count
            ")
            ->value('total_count');

            
            $father = DB::table('users')->where('id',$item['id'])
            ->selectRaw("
                SUM(
                    (adult_1 = 'Father') + (adult_2 = 'Father') + (spouse = 'Father')
                ) as total_count
            ")
            ->value('total_count');

        
            $mother = DB::table('users')->where('id',$item['id'])
            ->selectRaw("
                SUM(
                    (adult_1 = 'Mother') + (adult_2 = 'Mother') + (spouse = 'Mother')
                ) as total_count
            ")
            ->value('total_count');




            $kid_0_6 = DB::table('users')->where('id',$item['id'])
            ->selectRaw("
                SUM(
                    (kid_1 = '0-6') + (kid_2 = '0-6')
                ) as total_count
            ")
            ->value('total_count');
    
    
            $kid_7_12 = DB::table('users')->where('id',$item['id'])
            ->selectRaw("
                SUM(
                    (kid_1 = '7-12') + (kid_2 = '7-12')
                ) as total_count
            ")
            ->value('total_count');
    
            $kid_13_18 = DB::table('users')->where('id',$item['id'])
            ->selectRaw("
                SUM(
                    (kid_1 = '13-18') + (kid_2 = '13-18')
                ) as total_count
            ")
            ->value('total_count');

            $renamingMember = [];
            $missingRelations = '';
            $relationsInMembers = '';
            $filteredArray =[];
            $arr = ['Father', 'Mother', 'Father-in-law', 'Mother-in-law', 'Spouse'];
            $relationsInMembers = array_column($members, 'relation');
            $missingRelations = array_diff($arr, $relationsInMembers);
            foreach ($missingRelations as $missingRelation) {
                $filteredArray[] = [
                    'relation' => $missingRelation,
                    'name' => '',
                    'is_printed' => 0
                ];
            }
            $renamingMember = array_values($filteredArray);

            $filtered_data[] = [

                'id'   => isset($item['id']) ? $item['id'] : '',
                'category'   => isset($item['category']) ? $item['category'] : '',
                'name'   => isset($item['name']) ? $item['name'] : '',
                'first_name'   => isset($item['first_name']) ? $item['first_name'] : '',
                'last_name'   => isset($item['last_name']) ? $item['last_name'] : '',
                'email'   => isset($item['email']) ? $item['email'] : '',
                'country_code'   => isset($item['country_code']) ? $item['country_code'] : '',
                'phone'   => isset($item['phone']) ? $item['phone'] : '',

                'spouse'   => $spouse,
                'father'   => $father,
                'mother'   => $mother,
                'kid_0_6'   => $kid_0_6,
                'kid_7_12'   => $kid_7_12,
                'kid_13_18'   => $kid_13_18,
                'adult_1'   => isset($item['adult_1']) ? $item['adult_1'] : '',
                'adult_2'   => isset($item['adult_2']) ? $item['adult_2'] : '',
                'adult_3'   => isset($item['spouse']) ? $item['spouse'] : '',
                'adult1_name'   => isset($item['guest1_name']) ? $item['guest1_name'] : '',
                'adult2_name'   => isset($item['guest2_name']) ? $item['guest2_name'] : '',
                'adult3_name'   => isset($item['guest3_name']) ? $item['guest3_name'] : '',
                'kid_1'   => isset($item['kid_1']) ? $item['kid_1'] : '',
                'kid_2'   => isset($item['kid_2']) ? $item['kid_2'] : '',
                'kid1_name'   => isset($item['kid1_name']) ? $item['kid1_name'] : '',
                'kid2_name'   => isset($item['kid2_name']) ? $item['kid2_name'] : '',
                'unique_code'   => isset($item['unique_code']) ? $item['unique_code'] : '',
                'is_printed'    => $item['is_printed'],
                'is_printed_adult_1'    => $item['is_printed_adult_1'],
                'is_printed_adult_2'    => $item['is_printed_adult_2'],
                'is_printed_adult_3'    => $item['is_printed_adult_3'],
                'is_printed_kid_1'    => $item['is_printed_kid_1'],
                'is_printed_kid_2'    => $item['is_printed_kid_2'],
                'is_printed'    => $item['is_printed'],
                'status'    => $item['status'],
                'qrcode_path'    => $item['qrcode_path'],
                'eticket_path'    => $item['eticket_path'],
                'created_at'    => $item['created_at'],
                'updated_at'    => $item['updated_at'],
                'renamingtotal' => 3-$total,
                'renamingtotalkid' => 2-$kidtotal,
                "members" => $members,
                "renamingmembers" => $renamingMember,
                "renamingkids" => $renaminkid
            ];
        }
        

        if (!empty($userdata)) {
            $response = ['status' => true, 'message' => 'User Found.', 'data' =>  $filtered_data];
        } else {
            $response = ['status' => false, 'message' => 'User Not Found.'];
        }
        echo json_encode($response);
        die;
    }



    public function updateuser(Request $request)
    {
        $unique_code = $request->unique_code;
        $printer = explode(',',$request->relations);
        $badge_size = $request->badge_size ?? '';
        $us = null;
        if (!empty($unique_code)) {
            $users  =   DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code', $unique_code)->where('status', 1)->first();
            if (!empty($users)) {

                foreach ($printer as $key => $print) {
                    if ($print != 'self') {
                        $usdd = DB::table('users')
                            ->where('unique_code', $unique_code)
                            ->orWhere('emp_code', $unique_code)
                            ->where('status', 1)
                            ->where(function ($query) use ($print) {
                                $query->orWhere('adult_1', $print)
                                    ->orWhere('adult_2', $print)
                                    ->orWhere('spouse', $print)
                                    ->orWhere('kid_1', $print)
                                    ->orWhere('kid_2', $print);
                            })
                            ->select('adult_1', 'adult_2', 'spouse','kid_1','kid_2')
                            ->first();
                        if ($usdd) {
                  
                            if ($usdd->adult_1 == $print) {
                                DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code', $unique_code)->update(["is_printed_adult_1"=>1]);

                            }
                            if ($usdd->adult_2 == $print) {
                                DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code', $unique_code)->update(["is_printed_adult_2"=>1]);

                            }
                            if ($usdd->spouse == $print) {
                                DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code', $unique_code)->update(["is_printed_adult_3"=>1]);
                            }

                            if ($usdd->kid_1 == $print) {
                                
                                DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code', $unique_code)->update(["is_printed_kid_1"=>1]);
                            }
                            if ($usdd->kid_2 == $print) {
                                DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code', $unique_code)->update(["is_printed_kid_2"=>1]);
                            }
                            
                        }
                    }
                    if($print == 'self')
                    {
                        DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code', $unique_code)->update(['is_printed' => 1]);
                    }
                }
               
                   
                // $printUrl = '';
                // if (!empty($badge_size) && !empty($printer)) {
                //     $printUrl = route('printViewPage', [$printer, $badge_size, $users->id]);
                // }

                $response = ['status' => true, 'message' => 'Alloted Successfully.'];
            } else {
                $response = ['status' => false, 'message' => 'User Not found.'];
            }
        } else {
            $response = ['status' => false, 'message' => 'Unique code not found.'];
        }

        echo json_encode($response);
        die;
    }



    /* form fields */
    public function get_form_details($category_id)
    {

        if (!empty($category_id)) {
            $interface_form_data = DB::table('form_settings')->where('module_name','LIKE','%onsite%')->where('module_id', $category_id)->orderBy('form_squence')->get();
      
            if (!empty($interface_form_data)) {
                $response = ['status' => true, 'message' => 'data found', 'form_fields' => $interface_form_data];
            } else {
                $response = ['status' => false, 'message' => 'no record found or invalid category id.'];
            }
        } else {
            $response = ['status' => false, 'message' => 'Please provide category name.'];
        }

        echo json_encode($response);
        die;
    }

    /* save onpost registrations */
    public function usersave(Request $request)
    {
        $data  =  $request->all();
        $adultsArray= explode(',',$request->adults);
        foreach($adultsArray as $key => $adult)
        {
           if($key == 0 && $adult != '')
           {
               $data['guest1_name'] = $data['guest1_name'];
               $data['adult_1'] = $adult;
               $data['is_printed_adult_1'] = 1;
           }
           if($key == 1  && $adult != '')
           {
            $data['guest2_name'] = $data['guest2_name'];
            $data['adult_2'] = $adult;
            $data['is_printed_adult_2'] = 1;

           }
           if($key == 2  && $adult != '')
           {
            $data['guest3_name'] = $data['guest3_name'];
            $data['spouse'] = $adult;
            $data['is_printed_adult_3'] = 1;

           }
        }

        $user_data_array = [];
        $interface_form_data = DB::table('form_settings')->where('module_id', 1)->get();



        $interface_user = new User();

        $shortcode = "AT";

        $unique_code = $this->unicode_prefix . $shortcode . $this->unique_code();
        $qrcode_path = $this->generateQr($unique_code);


        $name = isset($data['name']) ? $data['name'] : '';
        $category = 'Employee';
        
       $empcode = $data['emp_code'];

        $adultcount = count($adultsArray);
        $kids = 0;
        if($data['kid_1'] != null && $data['kid_1'] != '')
        {
            $kids = 1;
            $data['is_printed_kid_1'] = 1;
        }
        if($data['kid_2'] != null && $data['kid_2'] != '')
        {
            $kids = $kids+1;
            $data['is_printed_kid_2'] = 1;
        }

         $eticket_path = $this->eticket($qrcode_path,$unique_code,strtoupper($data['name']),strtoupper($empcode) ,$category,$adultcount,$kids);

        // $meta_data = json_encode($user_data_array);
        $data['unique_code'] = $unique_code;
        $data['qrcode_path'] = $qrcode_path;
        $data['eticket_path'] = $eticket_path;
        $data['category'] = $category;
        $data['is_printed'] = 1;
        $data['status'] = 1;
        $data['attendees'] = 1;
        $data['user_type'] = 'onsite';
        $data['event_status'] = 1;
        $data['update_status'] = 1;
        $data['is_printed'] = 1;
        // echo "<pre>";print_r($data);die;

        $result = $interface_user->create($data);

        return response()->json(['status' => true, 'message' => 'User added successfully.', 'data' => $result]);
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
    public function redeem_adults_kids(Request $request)
    {
        
        $unique_id            = $request->unique_id;
        $redeem_extra_people  = $request->redeem_extra_people;

        try {
            $user = User::find($unique_id);
            
            if ($user) {
                $user->redeem_extra_people = $user->redeem_extra_people + $redeem_extra_people; 
                $result = $user->save();
            } else {
                return response()->json(['status' => false, 'message' => 'User Not Found.']);
            }

            DB::table('redeems_kids_adults_record')->insert([
                'unique_id'             => $unique_id,
                'redeem_no_of_people'   => $redeem_extra_people,
                'created_at'            => $this->now
            ]);

            if ($result) {
                return response()->json(['status' => true, 'message' => 'Alloted successfully.']);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }

         
    }

    public function addGuest(Request $request)
    {
         $arr = $request->all();

         $gustname = 
            (isset($arr['guest1_name']) ? $arr['guest1_name'] : '') .
            (isset($arr['guest2_name']) ? $arr['guest2_name'] : '') .
            (isset($arr['guest3_name']) ? $arr['guest3_name'] : '');

            $kidname = 
            (isset($arr['kid1_name']) ? $arr['kid1_name'] : '') .
            (isset($arr['kid2_name']) ? $arr['kid2_name'] : '');


         $adultname = !empty($gustname) ? explode(',', $gustname) : [];
         $kidsName = !empty($kidname) ? explode(',', $kidname) : [];

         $adult = !empty($arr['relation_adult']) ? explode(',', $arr['relation_adult']) : [];
        //  $kids= !empty($arr['relaioin_kid']) ? explode(',', $arr['relaioin_kid']) : [];

            $adultArrays = array_filter($adult, function ($value) {
                $trimmedValue = trim($value, " '\"");
                return $trimmedValue !== '';
            });

            // $kidsArray = array_filter($kids, function ($value) {
            //     $trimmedValue = trim($value, " '\"");
            //     return $trimmedValue !== '';
            // });

            // $kidArray = array_filter($kidsArray, function ($value) {
            //     return trim($value) !== '';
            // });
            $adultArray = array_filter($adultArrays, function ($value) {
                return trim($value) !== '';
            });


            $adultArrayName = array_filter($adultname, function ($value) {
                return trim($value) !== '';
            });

            // $kidArrayName = array_filter($kidsName, function ($value) {
            //     return trim($value) !== '';
            // });

            $data = [];
            if (count($adultArray) > 0) {
                // echo "<pre>";print_r($adultArray);die;
                foreach ($adultArray as $key => $adult) {
                    $check =  User::where('unique_code',$arr['unique_code'])->orWhere('emp_code',$arr['unique_code'])->first();
                    $name = $arr['guest' . ($key + 1) . '_name'];
                    if($check)
                    {
                        if ($check && ($check->adult_1 === null || $check->adult_1 === 'No')) {
                            $update = User::where('unique_code', $arr['unique_code'])->orWhere('emp_code',$arr['unique_code'])
                                ->update([
                                    'adult_1' => $adultArray[$key],
                                    'guest1_name' => $name,
                                    'is_printed_adult_1' => 1
                                ]);
                        } elseif ($check && ($check->adult_2 === null || $check->adult_2 === 'No')) {
                            $update = User::where('unique_code', $arr['unique_code'])->orWhere('emp_code',$arr['unique_code'])
                                ->update([
                                    'adult_2' => $adultArray[$key],
                                    'guest2_name' => $name,
                                    'is_printed_adult_2' => 1
                                ]);
                        } elseif ($check && ($check->spouse === null || $check->spouse === 'No')) {
                            $update = User::where('unique_code', $arr['unique_code'])->orWhere('emp_code',$arr['unique_code'])
                                ->update([
                                    'spouse' => $adultArray[$key],
                                    'guest3_name' => $name,
                                    'is_printed_adult_3' => 1
                                ]);
                        } 
                        
                }
                }
            }
            
            // if (count($kidArray) > 0) {

                foreach ($kidsName as $key => $kid) {
                    $checkkid =  User::where('unique_code',$arr['unique_code'])->orWhere('emp_code',$arr['unique_code'])->first();
                  
                    if($checkkid->kid_1 == null || $checkkid->kid_1 == 'No')
                    {
                        $data['kid_1'] = $arr['kid1_age'];
                        $data['kid1_name'] = $arr['kid1_name'];
                        $data['is_printed_kid_1'] =1;
                    }
                    if($checkkid->kid_2 == null || $checkkid->kid_2 == 'No')
                    {
                        $data['kid_2'] = $arr['kid2_age'];
                        $data['kid2_name'] = $arr['kid2_name'];
                        $data['is_printed_kid_2'] = 1;
                    }
                }
            // }
            // echo "<pre>";print_r($data);die;
            $data['unique_code'] = $arr['unique_code'];

            $interface_user =  User::where('unique_code',$arr['unique_code'])->orWhere('emp_code',$arr['unique_code'])->first();
            // echo "<pre>";print_r($interface_user);die;
            $interface_user->fill($data);
            $interface_user->save();

            

            if ($interface_user) {
                Guest::where('unique_code',$arr['unique_code'])->orWhere('emp_code',$arr['unique_code'])->delete();
                $guest = new Guest();
                $guest->fill($data);
                $guest->save();
                return response()->json(['status' => true, 'message' => 'Successfully add guest.']);
            }
            else
            {
                return response()->json(['status' => false, 'message' => 'Issue to add guest.']);
            }

        // } catch (\Exception $e) {
        //     return response()->json(['status' => false, 'message' => $e->getMessage()]);
        // }

    }

    public function alloteduser(Request $request)
    {
        $unique_code = $request->unique_code;
        if (!empty($unique_code)) {
            $users  =   DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code',$unique_code)->where('status', 1)->first();
            if (!empty($users)) {
                if ($users->delegate_kit_allot == 1) {
                    // $redeem = new Redeem();
                    $data1 = [
                        'user_id'       => $users->id,
                        'created_at'    => $this->now,
                        'updated_at'    => $this->now
                    ];
                    // $redeem->create($data1);
                } else {
                    DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code',$unique_code)->update(['delegate_kit_allot' => 1]);
                }
                $response = ['status' => true, 'message' => 'Aloted Successfully.'];
            } else {
                $response = ['status' => false, 'message' => 'User Not found.'];
            }
        } else {
            $response = ['status' => false, 'message' => 'Unique code not found.'];
        }

        echo json_encode($response);
        die;
    }

    

    public function printViewPage($printer, $badgeSize, $slug)
    {
        $user = User::findOrFail($slug);

        $parentDirectory = '';
        if ($badgeSize == '3.5X5') {
            $parentDirectory = '3x5';
        } else if ($badgeSize == '4X6') {
            $parentDirectory = '4x6';
        }

        $printView  = '';
        if ($printer == 'CanonTS307') {
            $printView  = 'canonts307';
        } else if ($printer == 'MG2570S') {
            $printView  = 'mg2570s';
        } else if ($printer == 'CanonG1010') {
            $printView  = 'canong1010';
        } else if ($printer == 'HP1020') {
            $printView  = 'hp1020';
        }

        return view('printing.' . $parentDirectory . '.' . $printView, compact('user', 'printer', 'badgeSize'));
    }

    public function allotDelegateKit(Request $request)
    {

        $unique_code = $request->unique_code;
        if (!empty($unique_code)) {
            $getUser = DB::table('entry_zapping')->where('location')->where('unique_code', $unique_code)->orWhere('emp_code', $unique_code)->first();

            if (empty($getUser)) {

                $userData = DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code', $unique_code)->first();

                if (!empty($userData)) {

                    DB::table('users')->where('unique_code', $unique_code)->orWhere('emp_code', $unique_code)->update(['delegate_kit_allot' => 1, 'kit_alloted_at' => $this->now]);


                    $data = [
                        'type' => $userData->user_type,
                        'location' => "Delegate Kit",
                        'unique_code' => $unique_code,
                        'category' => $userData->category,
                        'created_at' => $this->now,
                    ];

                    $result = DB::table('entry_zapping')->insertGetId($data);

                    $response = ['status' => true, 'message' => 'Alloted Successfully.'];
                } else {

                    $response = ['status' => false, 'message' => 'user not found.'];
                }
            } else {
                $response = ['status' => false, 'message' => 'Already Alloted.'];
            }
        } else {
            $response = ['status' => false, 'message' => 'uniquecode parameter missing.'];
        }


        echo json_encode($response);
        die;
    }

    public function categoriesRecord()
    {
        $interfacecategory = DB::table('user_interfaces')->where('status', 1)->pluck('category');
        if (!empty($interfacecategory)) {
            return $interfacecategory;
        } else {
            return $interfacecategory;
        }
    }

    public function edituserDetails(Request $request)
    {
        $unique_code = $request->unique_code;
        if (!empty($unique_code)) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|',
                'phone' => 'required',
                // 'designation' => 'required',
                'company' => 'required',
            ], [
                'first_name.required' => 'First name is required.',
                'last_name.required' => 'Last name is required.',
                'email.required' => 'Email is required.',
                'phone.required' => 'Phone is required.',
                // 'designation.required' => 'Designation is required.',
                'company.required' => 'Company is required.',
            ]);

            if ($validator->passes()) {
                $user = User::where('unique_code', $unique_code)->orWhere('emp_code',$unique_code)->first();

                if (!empty($user)) {
                    $customerData = [];
                    if (!empty($user->customer_data)) {
                        $customerData = json_decode($user->customer_data, true);

                        if (!empty($customerData)) {
                            foreach ($customerData as $key => $val) {
                                if (isset($request->$key)) {
                                    $customerData[$key] = $request->$key;
                                }
                            }
                        }
                    }
                    $customerData['note'] = !empty($request->note) ? $request->note : "";
                    // dd($customerData);

                    $data = [
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'name' => $request->first_name . ' ' . $request->last_name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'designation' => $request->designation,
                        'company' => $request->company,
                        'customer_data' => $customerData,
                    ];

                    $interface_data = Interfaces::where('category', $user->category)->first();

                    if (!empty($user->unique_code)) {
                        $unique_code = $user->unique_code;
                    } else {
                        $interface_data->shortcode = str_replace("BK", "", $interface_data->shortcode);
                        $unique_code = $this->unique_code_prefix . $interface_data->shortcode . (new UserController)->unique_code();
                        $data['unique_code'] = $unique_code;
                    }

                    $qrcode_path = (new UserController)->generateQr($unique_code, $data);

                    $eticket_path = (new EticketCreatorController)->eticket(strtoupper($data['first_name']), strtoupper($data['last_name']), $unique_code, $qrcode_path, strtoupper($data['company']), $interface_data->m_badge_design);

                    if (!empty($eticket_path)) {
                        $data['qrcode_path'] = $qrcode_path;
                        $data['eticket_path'] = $eticket_path;
                    }

                    $userData = $user->update($data);

                    $thirdPartyResponse = (new ThirdPartySharingController)->updateWebUser($user);

                    return response()->json(['status' => true, 'message' => 'User updated successfully.']);
                } else {
                    return response()->json(['status' => false, 'message' => 'no record found.']);
                }
            } else {
                return response()->json(['status' => false, 'message' => implode(",", $validator->errors()->all())]);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'no record found.']);
        }
    }


    public function resend_email(Request $request)
    {

        $unique_code = $request->unique_code;
        $childusersdata = User::where('unique_code', $unique_code)->first();
        // dd($childusersdata->email);
        if (isset($childusersdata)) {
            $type = "interface";
            $body = [
                'category'      => $childusersdata->category,
                'name'          => $childusersdata->name,
                'user_data'     => $childusersdata,
                'eticket_path'  => $childusersdata->eticket_path,
                'type'          => $type,
                'package_name'  => "",
                'user_name'     => $childusersdata->name,
            ];
            try {
                if ($childusersdata->email != '') {
                    $test = Mail::to($childusersdata->email)->send(new UserRegistrationOrderSummaryEmail($body));
                }

                if (!empty($childusersdata->phone)) {
                    (new WhatsappmsgController)->sendMbadge($childusersdata->country_code, $childusersdata->phone, $childusersdata->eticket_path, ucwords($childusersdata->first_name . ' ' . $childusersdata->last_name));
                }
                $data = array('status' => 'true', 'message' => 'Communication Resend Successfully.');
                echo json_encode($data);
                exit();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            $data = array('status' => 'false', 'message' => 'Something Went Wrong.');
            echo json_encode($data);
            exit();
        }
    }

    public function userCategoryUpdate(Request $request)
    {

        $data = array('status' => false, 'message' => 'For any category update contact helpdesk');
        echo json_encode($data);
        exit();


        $category = $request->category;
        $userId = $request->userId;

        $interface_data = Interfaces::where('category', $category)->first();

        if (!empty($userId) && !empty($interface_data)) {
            $user = User::where('id', $userId)->where('status', 1)->first();

            if (!empty($user)) {
                $userDataUpdate = [
                    'category' => $category,
                ];

                if (!empty($user->unique_code)) {
                    $unique_code = $user->unique_code;
                } else {
                    $interface_data->shortcode = str_replace("BK", "", $interface_data->shortcode);
                    $unique_code = $this->unique_code_prefix . $interface_data->shortcode . (new UserController)->unique_code();
                    $userDataUpdate['unique_code'] = $unique_code;
                }

                $qrcode_path = (new UserController)->generateQr($unique_code, $user->toArray());

                $eticket_path = (new EticketCreatorController)->eticket(strtoupper($user->first_name), strtoupper($user->last_name), $unique_code, $qrcode_path, strtoupper($user->company), $interface_data->m_badge_design);

                if (!empty($eticket_path)) {
                    $userDataUpdate['qrcode_path'] = $qrcode_path;
                    $userDataUpdate['eticket_path'] = $eticket_path;
                }

                $oldCategory = $user->category;

                $oldData = [
                    'user_type' => $user->user_type,
                    'category' => $user->category,
                    'exhibitor_name' => $user->exhibitor_name,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'designation' => $user->designation,
                    'company' => $user->company,
                    'festival_dates' => $user->festival_dates,
                    'country' => $user->country,
                    'state' => $user->state,
                    'city' => $user->city,
                    'unique_code' => $user->unique_code,
                    'qrcode_path' => $user->qrcode_path,
                    'eticket_path' => $user->eticket_path,
                    'customer_data' => $user->customer_data,
                    'status' => $user->status,
                ];

                $user->update($userDataUpdate);

                // UserCategoryUpgrade
                $existUpgradeUser = UserCategoryUpgrade::where('user_id', $userId)->first();

                $newdata = [
                    'user_type' => $user->user_type,
                    'category' => $user->category,
                    'exhibitor_name' => $user->exhibitor_name,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'designation' => $user->designation,
                    'company' => $user->company,
                    'festival_dates' => $user->festival_dates,
                    'country' => $user->country,
                    'state' => $user->state,
                    'city' => $user->city,
                    'unique_code' => $user->unique_code,
                    'qrcode_path' => $user->qrcode_path,
                    'eticket_path' => $user->eticket_path,
                    'customer_data' => $user->customer_data,
                    'status' => $user->status,
                ];

                $userUpgradedRecord = [
                    'user_id' => $user->id,
                    'old_category' => $oldCategory,
                    'new_category' => $category,
                    'old_data' => json_encode($oldData),
                    'new_data' => json_encode($newdata),
                ];
                // dd($existUpgradeUser);

                if (!empty($existUpgradeUser)) {
                    $existUpgradeUser->update($userUpgradedRecord);
                } else {
                    $userCategoryUpgrade = new UserCategoryUpgrade();
                    $userCategoryUpgrade->create($userUpgradedRecord);
                }

                $thirdPartyResponse = (new ThirdPartySharingController)->updateWebUser($user);

                $category = str_replace("BK ", "", $category);

                if ($user->email != '') {
                    $body = [
                        'first_name' => $user->first_name . ' ' . $user->last_name,
                        'unique_code' => $user->unique_code,
                        'eticket_path' => $user->eticket_path
                    ];

                    Mail::to($user->email)->send(new BkInterfaceEmail($body));
                }

                if (!empty($user->phone)) {
                    (new WhatsappmsgController)->confirmation_msg($user->country_code, $user->phone, $eticket_path, ucwords($user->first_name . ' ' . $user->last_name), $category, $unique_code);
                }

                $data = array('status' => true, 'message' => 'Category updated successfully.');
            } else {
                $data = array('status' => false, 'message' => 'No record found.');
            }
        } else {
            $data = array('status' => false, 'message' => 'something went wrong.');
        }

        echo json_encode($data);
        exit();
    }

    /* Bulk Printing Module Start */
    public function searchFields()
    {

        $searchFields = array(
            array("display_name" => "Name", "key" => "name", "value" => "text"),
            array("display_name" => "Email", "key" => "email", "value" => "text"),
            array("display_name" => "Mobile No.", "key" => "mobile", "value" => "text"),
            array("display_name" => "Unique Code", "key" => "unique_code", "value" => "text"),
            array("display_name" => "Company", "key" => "company", "value" => "text"),
            array("display_name" => "Designation", "key" => "designation", "value" => "text"),
            array("display_name" => "Exhibitor Name", "key" => "exhibitor_name", "value" => "text"),
            array("display_name" => "Category", "key" => "category", "value" => "select", "items" => $this->categoriesRecord()),
            array("display_name" => "Print Status", "key" => "print_status", "value" => "select", "items" => array('Not Printed', 'Printed')),
            //                 array("display_name"=>"Go To","key"=>"go_to","value"=>"number")
        );


        return Response::json(array('status' => true, 'message' => 'Data found.', 'data' => $searchFields), 200);
    }

    public function bulkRecord(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $unique_code = $request->input('unique_code');
        $company = $request->input('company');
        $designation = $request->input('designation');
        $exhibitor_name = $request->input('exhibitor_name');
        $category = $request->input('category');
        $print_status = $request->input('print_status');
        $goto = $request->input('go_to');


        if (!empty($name) || !empty($email) || !empty($mobile) || !empty($unique_code) || !empty($company) || !empty($designation) || !empty($exhibitor_name) || !empty($category) || !empty($print_status)) {
            $userdata = DB::table('users')->where('status', 1);


            if (!empty($name)) {
                $userdata->where('name', 'LIKE', '%' . $name . '%');
            }
            if (!empty($email)) {
                $userdata->where('email', 'LIKE', '%' . $email . '%');
            }
            if (!empty($mobile)) {
                $userdata->where('phone', 'LIKE', '%' . $mobile . '%');
            }
            if (!empty($mobile)) {
                $userdata->where('phone', 'LIKE', '%' . $mobile . '%');
            }
            if (!empty($unique_code)) {
                $userdata->where('unique_code', 'LIKE', '%' . $unique_code . '%');
            }
            if (!empty($company)) {
                $userdata->where('company', 'LIKE', '%' . $company . '%');
            }
            if (!empty($designation)) {
                $userdata->where('designation', 'LIKE', '%' . $designation . '%');
            }
            if (!empty($exhibitor_name)) {
                $userdata->where('exhibitor_name', 'LIKE', '%' . $exhibitor_name . '%');
            }
            if (!empty($category)) {
                $userdata->where('category', 'LIKE', '%' . $category . '%');
            }
            if (!empty($print_status)) {
                if ($print_status == 'Not Printed') {
                    $print_status1 = 0;
                }

                if ($print_status == 'Printed') {
                    $print_status1 = 1;
                }

                $userdata->where('is_printed', '=', $print_status1);
            }

            $records = $userdata->paginate(10);

            // dd($records);
            //$records=$userdata->skip($offsetValue)->take(10)->get();
            // echo $userdata->toSql();


            return Response::json(array('status' => true, 'data' => $records), 200);
        } else {

            $userdata = User::where('status', 1)->paginate(10);
            return Response::json(array('status' => true, 'message' => 'Data found.', 'data' => $userdata), 200);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $codes = $request->input('code');

        if (!empty($codes)) {
            $codeArray = explode(',', $codes);
            // $users  =   DB::table('users')->where('status',1)->whereIn('unique_code', $codeArray)->get();
            DB::table('users')->whereIn('unique_code', $codeArray)->update(['is_printed' => 1, 'printed_at' => $this->now]);
            $response = ['status' => true, 'message' => 'Alloted Successfully.'];
        } else {
            $response = ['status' => false, 'message' => 'Unique code not found.'];
        }
        echo json_encode($response);
        die;
    }

    /* Bulk Printing Module End */



    public function statusupdate(Request $request)
    {
        $unique_code = $request->unique_code;

        $users =  DB::table('users')->where('unique_code', $unique_code)->first();
        if ($users->status == 1) {
            DB::table('users')->where('unique_code', $unique_code)->update(['status' => 2, 'status_at' => $this->now]);
            $response = ['status' => true, 'message' => 'User Deactivated Successfully'];
        } else {
            DB::table('users')->where('unique_code', $unique_code)->update(['status' => 1, 'status_at' => $this->now]);
            $response = ['status' => true, 'message' => 'User Activated Successfully.'];
        }
        echo json_encode($response);
        die;
    }

    public function fetch_category(Request $request)
    {

        $eventid = $request->event_id ?? '';
        $query = DB::table('tickets')
            ->select('id', 'category as name')
            ->where('event_id', $eventid)
            ->where('user_type', 'LIKE', '%onsite%')
            ->where('status', 1);

        $categorieslist = $query->get();

        if ($categorieslist->isEmpty()) {
            return response()->json([
                'status' => 0,
                'message' => 'Categories not found',
            ]);
        }

        return response()->json([
            'status' => 1,
            'message' => 'Total ' . $categorieslist->count() . ' found',
            'categories' => $categorieslist,
        ]);
    }
}
