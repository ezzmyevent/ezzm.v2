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

        $pendingCount = DB::table('users')->where('slot',Null)->count();
        $successCount = DB::table('users')->where('slot','!=',"")->count();


        return view('admin.dashboard.dashboard', compact('title','user_count_data','userRecord','attendee_count_data','redeem_count_data','category_count_data','pendingCount','successCount'));

       
                   
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
