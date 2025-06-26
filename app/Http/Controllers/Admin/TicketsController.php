<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Rules\FestivalDates;
use DB, Storage, Validator, Config;

class TicketsController extends Controller
{
    public function __construct() {
        $this->now = Carbon::now();
    }

    public function index()
    {
        $pagination = 'yes';
        $tickets = Ticket::paginate(25);

        return view('admin.tickets.index')->with('tickets', $tickets)->with('pagination', $pagination);
    }

    public function add()
    {
        $ticket_category = TicketCategory::get();

        return view('admin.tickets.add')->with('ticket_category', $ticket_category);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0|',
            'min_qty' => 'required|numeric|min:0|',
            'max_qty' => 'required|numeric|min:1|',
            'day_qty' => 'required',
        ],[
            'category.required' => 'Category is required.',
            'name.required' => 'Name is required.',
            'description.required' => 'Description is required.',
            'price.required' => 'Price is required.',
            'min_qty.required' => 'Min quantity is required.',
            'max_qty.required' => 'Max quantity is required.',
            'day_qty.required' => 'Day quantity is required.',
        ]);

        if ($validator->passes()) {
            $ticket_category_details = TicketCategory::where('name', $request->category)->first();

            $tickets = new Ticket();
            
            if(isset($request->custom_price) && $request->custom_price != '') {
                $data = [
                    'name' => $request->name,
                    'category' => $request->category,
                    'slug' => $ticket_category_details->slug,
                    'description' => $request->description,
                    'price' => $request->price,
                    'ages_6_and_below' => $request->ages_6_and_below,
                    'ages_7_to_11' => $request->ages_7_to_11,
                    'ages_12_to_17' => $request->ages_12_to_17,
                    'min_qty' => $request->min_qty,
                    'max_qty' => $request->max_qty,
                    'day_qty' => $request->day_qty,
                    'status' => 1,
                    'created_at' => $this->now,
                    'updated_at' => $this->now,
                ];
            } else {
                $data = [
                    'name' => $request->name,
                    'category' => $request->category,
                    'slug' => $ticket_category_details->slug,
                    'description' => $request->description,
                    'price' => $request->price,
                    'min_qty' => $request->min_qty,
                    'max_qty' => $request->max_qty,
                    'day_qty' => $request->day_qty,
                    'status' => 1,
                    'created_at' => $this->now,
                    'updated_at' => $this->now,
                ];
            }

            $tickets->create($data);
            
            return true;

        } else {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    public function view(Request $request)
    {
        $tickets = Ticket::where('id', $request->id)->first();

        return view('admin.tickets.view')->with('tickets', $tickets);
    }

    public function status(Request $request)
    {
        $tickets = Ticket::where('id', $request->id)->update(['status' => $request->status]);

        return true;
    }
}
