<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMember;
use App\Models\Invitees;
use App\Models\InterfaceUserRegistrations;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
        * Instantiate a new controller instance.
        *
        * @return void
    */

    public function __construct()
    {
        $this->now = Carbon::now();
    }
    
    public function index()
    {
        $title = 'Admin Dashboard';

        $usercount=DB::table('users')->select('user_type',DB::raw('count(*) as total'))->groupBy('user_type')->get();

        $user_count_data=[];
        foreach($usercount as $user)
        {
           $user_count_data[$user->user_type]=$user->total;
        }
        $redeemCount=DB::table('users')->select('user_type',DB::raw('count(*) as total'))->where('status',1)->where('is_printed',1)->groupBy('user_type')->get();

        $redeem_count_data=[];
        foreach($redeemCount as $redeem)
        {
            $redeem_count_data[$redeem->user_type]=$redeem->total;
        }


        $userRecord=DB::table('users')->where('status',1)->orderBy('id', 'desc')->limit(5)->get();

        $attendeecount=DB::table('entry_zapping')
                            ->select(DB::raw('count(DISTINCT(`unique_code`)) as total,type,location'))
                            ->groupBy('location','type')->get();


        $attendee_count_data=[];
        foreach($attendeecount as $attendee)
        {
                $attendee_count_data[$attendee->location][$attendee->type]=$attendee->total;
        }

        $categoryCount=DB::table('users')->select('user_type','category',DB::raw('count(*) as total'))->where('status',1)->where('is_printed',1)->groupBy('user_type','category')->get();
        $category_count_data=[];
        foreach($categoryCount as $category)
        {
            $category_count_data[$category->category][$category->user_type]=$category->total;
        }

        $pendingCount = DB::table('users')->where('status',0)->count();
        $successCount = DB::table('users')->whereIn('event_status',[1, 2])->where('status',1)->count();
        $NoAttend = DB::table('users')->where('event_status',2)->count();
        $zappingCount = DB::table('entry_zapping')->count();
        
        
        $userData = DB::table('users')->where('status',1)->get();
        $mainUserCount = count($userData);
        $memberCount = 0;
        // $adult1 = 0;
        $attendeesyes = 0;
        $attendeesno = 0;
        $kid_0_6 = 0;
        $kid_7_12 = 0;
        $kid_13_18 = 0;

        $userGoodieData = DB::table('users')->where('is_goodies',1)->get();
        $mainUserGoodieCount = count($userGoodieData);
        $memberGoodieCount = 0;
        if(!$userData->isEmpty()){
            foreach ($userData as $key => $value) {
                if($value->event_status == 1){
                   $attendeesyes += 1;
                }

                if($value->event_status == 2){
                   $attendeesno += 1;
                }
            }
        }
        $spouse = DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                (adult_1 = 'Spouse') + (adult_2 = 'Spouse') + (spouse = 'Spouse')
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');

        $totalredeem = 0;

        $spouseCount =   DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                CASE WHEN adult_1 = 'Spouse' AND is_printed_adult_1 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN adult_2 = 'Spouse' AND is_printed_adult_2 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN spouse = 'Spouse' AND is_printed_adult_3 = 1 THEN 1 ELSE 0 END
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');


        $FatherCount =   DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                CASE WHEN adult_1 = 'Father' AND is_printed_adult_1 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN adult_2 = 'Father' AND is_printed_adult_2 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN spouse = 'Father' AND is_printed_adult_3 = 1 THEN 1 ELSE 0 END
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');


        $MotherCount =   DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                CASE WHEN adult_1 = 'Mother' AND is_printed_adult_1 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN adult_2 = 'Mother' AND is_printed_adult_2 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN spouse = 'Mother' AND is_printed_adult_3 = 1 THEN 1 ELSE 0 END
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');

        $FatherinlawCount =   DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                CASE WHEN adult_1 = 'Father-in-law' AND is_printed_adult_1 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN adult_2 = 'Father-in-law' AND is_printed_adult_2 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN spouse = 'Father-in-law' AND is_printed_adult_3 = 1 THEN 1 ELSE 0 END
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');

        $MotherinlawCount =   DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                CASE WHEN adult_1 = 'Mother-in-law' AND is_printed_adult_1 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN adult_2 = 'Mother-in-law' AND is_printed_adult_2 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN spouse = 'Mother-in-law' AND is_printed_adult_3 = 1 THEN 1 ELSE 0 END
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');


        $kidCount1 =   DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                CASE WHEN kid_1 = '0-6' AND is_printed_kid_1 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN kid_2 = '0-6' AND is_printed_kid_2 = 1 THEN 1 ELSE 0 END
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');


        $kidCount2 =   DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                CASE WHEN kid_1 = '7-12' AND is_printed_kid_1 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN kid_2 = '7-12' AND is_printed_kid_2 = 1 THEN 1 ELSE 0 END
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');


        $kidCount3 =   DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                CASE WHEN kid_1 = '13-18' AND is_printed_kid_1 = 1 THEN 1 ELSE 0 END
            ) +
            SUM(
                CASE WHEN kid_2 = '13-18' AND is_printed_kid_2 = 1 THEN 1 ELSE 0 END
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');


        $father = DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                (adult_1 = 'Father') + (adult_2 = 'Father') + (spouse = 'Father')
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');


        

        $mother = DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                (adult_1 = 'Mother') + (adult_2 = 'Mother') + (spouse = 'Mother')
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');



        $fatherinlaw = DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
            user_type,
            SUM(
                (adult_1 = 'Father-in-law') + (adult_2 = 'Father-in-law') + (spouse = 'Father-in-law')
            ) as total_count
        ")
        ->groupBy('user_type')
        ->pluck('total_count', 'user_type');

        
        $motherinlaw = DB::table('users')->where('status',1)
        ->whereIn('user_type', ['online', 'onsite'])
        ->selectRaw("
        user_type,
        SUM(
            (adult_1 = 'Mother-in-law') + (adult_2 = 'Mother-in-law') + (spouse = 'Mother-in-law')
            ) as total_count
            ")
            ->groupBy('user_type')
            ->pluck('total_count', 'user_type');
            
            
            
            $kid_0_6 =  DB::table('users')->where('status',1)
            ->whereIn('user_type', ['online', 'onsite'])
            ->selectRaw("
            user_type,
            SUM(CASE WHEN kid_1 = '0-6' THEN 1 ELSE 0 END) +
            SUM(CASE WHEN kid_2 = '0-6' THEN 1 ELSE 0 END) as total_count
            ")
            ->groupBy('user_type')
            ->pluck('total_count', 'user_type');
            
            
            
            
            
            $kid_7_12 = DB::table('users')->where('status',1)
            ->whereIn('user_type', ['online', 'onsite'])
            ->selectRaw("
            user_type,
            SUM(CASE WHEN kid_1 = '7-12' THEN 1 ELSE 0 END) +
            SUM(CASE WHEN kid_2 = '7-12' THEN 1 ELSE 0 END) as total_count
            ")
            ->groupBy('user_type')
            ->pluck('total_count', 'user_type');
            
            
            
            $kid_13_18 = DB::table('users')->where('status',1)
            ->whereIn('user_type', ['online', 'onsite'])
            ->selectRaw("
            user_type,
            SUM(CASE WHEN kid_1 = '13-18' THEN 1 ELSE 0 END) +
            SUM(CASE WHEN kid_2 = '13-18' THEN 1 ELSE 0 END) as total_count
            ")
            ->groupBy('user_type')
            ->pluck('total_count', 'user_type');
            
            $kidisprint = 0;
            $kidisprintonsite = 0;
            $kidisprintgift = 0;
            $is_printed_adult_1 = DB::table('users')->where('is_printed_adult_1',1)->where('status',1)->count();
            $is_printed_adult_2 = DB::table('users')->where('is_printed_adult_2',1)->where('status',1)->count();
            $is_printed_adult_3 = DB::table('users')->where('is_printed_adult_3',1)->where('status',1)->count();
            $is_printed_kid_1 = DB::table('users')->where('is_printed_kid_1',1)->where('status',1)->count();
            $is_printed_kid_2 = DB::table('users')->where('is_printed_kid_2',1)->where('status',1)->count();
            
        $isPrintSelf = DB::table('users')->where('is_printed',1)->where('status',1)->count();


        $totalredeem += $isPrintSelf+$is_printed_adult_3+$is_printed_adult_2+$is_printed_adult_1+$is_printed_kid_1+$is_printed_kid_2 ;


        $result = User::join('entry_zapping','entry_zapping.unique_code','users.unique_code')->where('users.status',1)->select('users.*')->get();
        $c = 0;
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
        // echo $c;die;
        // $zapping = DB::table('entry_zapping')->select('unique_code')->pluck('unique_code');
        // $users = User::whereIn('unique_code', $zapping)
        //     ->where('kid_1','0-6')->where('is_printed_kid_1',1)
        //     ->count();


        //     $users1 = User::whereIn('unique_code', $zapping)
        //     ->where('kid_2','0-6')->where('is_printed_kid_2',1)
        //     ->count();




        //     $users2 = User::whereIn('unique_code', $zapping)
        //     ->where('kid_1','7-12')->where('is_printed_kid_1',1)
        //     ->count();


        //     $users3 = User::whereIn('unique_code', $zapping)
        //     ->where('kid_2','7-12')->where('is_printed_kid_2',1)
        //     ->count();


        // $k1count = 0;
        // $k2count = 0;
        
        // foreach ($users as $user) {
        //     if ($user->kid_1 === '0-6' && $user->is_printed_kid_1 == 1) {
        //         $k1count++;
        //     
        //     if ($user->kid_2 === '0-6' && $user->is_printed_kid_2 == 1) {
        //         $k1count++;
        //     }
        //     if ($user->kid_1 === '07-12' && $user->is_printed_kid_1 == 1) {
        //         $k2count++;
        //     }
        //     if ($user->kid_2 === '07-12' && $user->is_printed_kid_2 == 1) {
        //         $k2count++;
        //     }
        // }
        
        $kidisprintgift = $c;

        return view('admin.dashboard.dashboard', compact('title','user_count_data','userRecord','attendee_count_data','redeem_count_data','category_count_data','pendingCount','successCount','mainUserCount','memberCount','attendeesno','attendeesyes','spouse','father','mother','fatherinlaw','motherinlaw','kid_0_6','kid_7_12','kid_13_18','isPrintSelf','spouseCount','FatherCount','MotherCount','MotherinlawCount','FatherinlawCount','kidCount1','kidCount2','kidCount3','NoAttend','zappingCount','totalredeem','kidisprintgift'));

       
                   
    }

    public function dashboardpage()
    {
        $title = 'Admin Dashboard';

        $usercount=DB::table('users')->select('user_type',DB::raw('count(*) as total'))->where('status',1)->groupBy('user_type')->get();

        $user_count_data=[];
        foreach($usercount as $user)
        {
            $user_count_data[$user->user_type]=$user->total;
        }

        $redeemCount=DB::table('users')->select('user_type',DB::raw('count(*) as total'))->where('status',1)->where('is_printed',1)->groupBy('user_type')->get();

        $redeem_count_data=[];
        foreach($redeemCount as $redeem)
        {
            $redeem_count_data[$redeem->user_type]=$redeem->total;
        }


        $userRecord=DB::table('users')->where('status',1)->orderBy('id', 'desc')->limit(5)->get();

        $attendeecount=DB::table('entry_zapping')
            ->select(DB::raw('count(DISTINCT(`unique_code`)) as total,type,location'))
            ->groupBy('location','type')->get();


        $attendee_count_data=[];
        foreach($attendeecount as $attendee)
        {
            $attendee_count_data[$attendee->location][$attendee->type]=$attendee->total;
        }

        $categoryCount=DB::table('users')->select('user_type','category',DB::raw('count(*) as total'))->where('status',1)->where('is_printed',1)->groupBy('user_type','category')->get();
       $category_count_data=[];
       foreach($categoryCount as $category)
       {
           $category_count_data[$category->category][$category->user_type]=$category->total;
       }


        return view('admin.dashboard.dashboard', compact('title','user_count_data','userRecord','attendee_count_data','redeem_count_data','category_count_data'));

    }

    public function eventStatus($status)
    {
        // echo $status; die();

        $result = DB::table('master_settings')->where('module_name', 'event_status')->update(['status' => $status, 'updated_at' => $this->now]);
        $data = array('type' => 'Success', 'message' => 'Event Status have been Updated successfully', 'status' => $status);
        echo json_encode($data);
        exit();

        // return redirect("admin/index")->with('title', 'event_status');
    }

    public function mastersearch(Request $request)
    {
        $title = 'Master Search';

        $data = [];
        if(!empty( $request->input(['post_type'])) ) {
            $field = $request->field;
            $search = $request->search;
            
            if(!empty($field) && !empty($search)) {
                $users = User::where($request->field, 'LIKE', '%' . $request->search .'%')->get();
                $data[] = ['user_data' => $users];

                $users_member = UserMember::where($request->field, 'LIKE', '%' . $request->search .'%')->get();
                $data[] = ['user_members_data' => $users_member];

                $complementary_invitees = Invitees::where($request->field, 'LIKE', '%' . $request->search .'%')->get();
                $data[] = ['complementary_invitees' => $complementary_invitees];

                $invited_user = InterfaceUserRegistrations::where('user_interface_id', 1)->where($request->field, 'LIKE', '%' . $request->search .'%')->with('invitedBy')->get();
                $data[] = ['invited_user' => $invited_user];
                
                $interface_user = InterfaceUserRegistrations::where('user_interface_id', '!=', 1)->where($request->field, 'LIKE', '%' . $request->search .'%')->with('userInterfaces')->get();
                $data[] = ['interface_user' => $interface_user];
                
            }
        }

        return View('admin.dashboard.mastersearch', compact('title','data'));
    }
}
