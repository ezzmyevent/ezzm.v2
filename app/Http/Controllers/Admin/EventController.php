<?php
    
namespace App\Http\Controllers\Admin;
    
use App\Models\{User, Uniquecode, UserMember, Banner, FieldSetting};
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Http\Controllers\Controller;
use DB, Storage, Validator, Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
    
class EventController extends Controller
{
    public function __construct() {
        $this->now = Carbon::now();
    }
    
    public function index(Request $request) {

    }

    public function event_details() {
        return view('admin.event.event-details');
    }

    public function uploadImg(Request $request)
    {
        $image = $request->image;
        $imageInfo = explode(";base64,", $image);

        $imgExt = str_replace('data:image/', '', $imageInfo[0]);      
        $image = str_replace(' ', '+', $imageInfo[1]);

        if($imgExt == 'png' || $imgExt == 'jpg' || $imgExt == 'jpeg' || $imgExt == 'gif')
        {
            $imageName = uniqid()."".time().".".$imgExt;

            $document_path = Storage::disk('s3')->put("jlf2023/Banners/".$imageName, base64_decode($image));    
            $document_path = Storage::disk('s3')->url("jlf2023/Banners/".$imageName, base64_decode($image));

            // echo $document_size = Storage::disk('s3')->size("jlf2023/Banners/".$imageName, base64_decode($image));
            // die();

            $actual_filename = $request->filename;

            Banner::insert(
                [
                    'event_id' => 1, 
                    'name' => $actual_filename,
                    'url' => $document_path,
                    'status' => 1,
                    'created_at' => $this->now,
                    'updated_at' => $this->now,
                ]
            );

            return response()->json(['response'=>'success', 'file_name'=>$document_path]);
        }
        else
        {
            return "Error";
        }
    }



}