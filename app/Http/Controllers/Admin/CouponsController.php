<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Ticket;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DB, Storage;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class CouponsController extends Controller
{
    public function __construct()
    {
        $this->now = Carbon::now();

    }

    public function index(Request $request)
    {
        
        $title = 'Coupons';
        $search = '';
        if(isset($request->search) && $request->search != '')
        {
            
            $pagination = 'no';
            $search = $request->search;
            $data = Coupon::select("*")
                ->when($request->search, function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search .'%');
                    $query->orWhere('code', 'LIKE', '%' . $request->search .'%');
                    $query->orWhere('amount', 'LIKE', '%' . $request->search .'%');
                })
                ->get();

        } else {

            $data = Coupon::paginate(50);
            $pagination = 'yes';

        }

        return view('admin.coupons.index', compact('title','data','pagination','search'));
    }

    public function add(Request $request)
    {
        $ticket =Ticket::select('id','name','category')->where('status','1')->get();

        return view('admin.coupons.add', compact('ticket'));
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'description' => 'required',
            'coupon_type' => 'required',
            'amount' => 'required|numeric|min:1|',
            'starting_at' => 'required',
        ],[
            'name.required' => 'Name is required.',
            'code.required' => 'Code is required.',
            'description.required' => 'Description is required.',
            'coupon_type.required' => 'Coupon type is required.',
            'amount.required' => 'Amount is required.',
            'starting_at.required' => 'Starting date is required.',
        ]);

        if ($validator->passes()) {
            $startingDate=explode("T",$request->starting_at);
            $startingDate= implode(" ",$startingDate);

            $endingDate=explode("T",$request->ending_at);
            $endingDate= implode(" ",$endingDate);

            if(in_array('Cart', $request->ticket_id)) {
                $ticket_id = 'Cart';
            } else {
                $ticket_id = implode(",",$request->ticket_id);
            }

            $data = [
                'ticket_id' => $ticket_id,
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'coupon_type' => $request->coupon_type,
                'amount' => $request->amount,
                'starting_at' => $startingDate,
                'ending_at' => $endingDate,
                'status' => "1",
                'created_at' => $this->now,
                'updated_at' => $this->now
            ];
            $result = Coupon::create($data);
            return true;
        } else {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    public function view(Request $request)
    {
        $coupon = Coupon::where('id', $request->id)->first();

        $all_ticket_added = [];
        if($coupon->ticket_id == 'Cart') {
            $all_ticket_added[] = [
                "name" => "Cart",
                "category" => '',
            ];
        } else {
            $tickets = explode(',', $coupon->ticket_id);
            foreach($tickets as $key => $value) {
                $ticket = Ticket::select(['id', 'name', 'category'])->where('id', $value)->first();
                $all_ticket_added[] = [
                    "name" => $ticket->name,
                    "category" => $ticket->category,
                ];
            }
        }

        return view('admin.coupons.view')->with('coupon', $coupon)->with('all_ticket_added', $all_ticket_added);
    }

    public function status(Request $request)
    {
        $Coupon = Coupon::where('id', $request->id)->update(['status' => $request->status]);

        return true;
    }

    public function delete(Request $request)
    {
        $Coupon = Coupon::where('id', $request->id)->delete();

        return true;
    }
}
