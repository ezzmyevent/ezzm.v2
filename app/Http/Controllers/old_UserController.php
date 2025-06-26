<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Uniquecode;
use App\Models\Country;
use App\Models\UserMember;
use Illuminate\Support\Facades\Auth;
use DB, Storage, Validator, Config;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationEmail;
use App\Mail\RegisterEmail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Razorpay\Api\Api;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */

    public function __construct() {
        $this->now = Carbon::now();
    }

    public function index() {
        return redirect('register');
    }

    public function FeedbackForm()
    {
        return view('user.feedback_form');
    }

    public function saveFeedback(Request $request) 
    {

        // dd($request);

        $validator = $request->validate(
            [
                'name' => 'required',
                'company_name' => 'required',
                'designation' => 'required',
                'mobile_no' => 'required',
                'email' => 'required',
                'feed_1' => 'required',
                'feed_2' => 'required',
                'feed_3' => 'required',
                'feed_4' => 'required',
                'feed_5' => 'required',
                'feed_6' => 'required',
                'feed_7' => 'required',
                'feed_8' => 'required',           
            ],
            [
                'name.required' => 'Required',
                'company_name.required' => 'Required',
                'designation.required' => 'Required',
                'mobile_no.required' => 'Required',
                'email.required' => 'Required',
                'feed_1.required' => 'Required.',
                'feed_2.required' => 'Required.',
                'feed_3.required' => 'Required.',
                'feed_4.required' => 'Required.',
                'feed_5.required' => 'Required.',
                'feed_6.required' => 'Required.',
                'feed_7.required' => 'Required.',
                'feed_8.required' => 'Required.',           
            ]
        );

$feed_4_final = '';

        foreach ($request->feed_4 as $key => $value) {
            $feed_4_final .= $value.', ';
        }

        $finalArray=array(
            'name' => $request->name,
            'company_name' => $request->company_name,
            'designation' => $request->designation,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'feed_1' => $request->feed_1,
            'feed_2' => $request->feed_2,
            'feed_3' => $request->feed_3,
            'feed_4' => rtrim($feed_4_final, ', '),
            'feed_5' => $request->feed_5,
            'feed_6' => $request->feed_6,
            'feed_7' => $request->feed_7,
            'feed_8' => $request->feed_8,
            'created_at'=>$this->now,
            'updated_at'=>$this->now,
        );

        $insertId = Feedback::insertGetId($finalArray);


        if(!empty($insertId))
        {
            return response()->json([
                'type' => 'Success',
                'intended' => 'home',
                'message' => 'Registration Successfully!!'
            ]);
        }
        else
        {
            return response()->json([
                'type' => 'False',
                'intended' => 'home',
                'message' => 'Please try again later, something wents wrong!!!'
            ]);
        }

    }

}