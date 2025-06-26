<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use App\Models\Uniquecode;
    use App\Models\User;
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\File;
    use Storage, DB;
    use App\Mail\OnlineRegisterEmail;
    use App\Mail\ReminderEmail;
    use App\Mail\FeedbackEmail;

    

    class EmailController extends Controller
    {
        public function ConfirmationEmail($limit)
        {
            // exit('ConfirmationEmail');

            $users = User::where('user_type', 'online')->where('email_send', 0)->where('email','!=','')->limit($limit)->get();

            foreach ($users as $user)
            {
                $body = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'qrcode_path' => $user->qrcode_path,
                    'eticket_path' => $user->eticket_path,
                ];

                Mail::to($user->email)->send(new OnlineRegisterEmail($body));

                if(Mail::failures() != 0)
                {                
                    User::where('id', $user->id)->update(['email_send' => 1]);
                    echo "<p> Message Sent. </p>";
                }
                else
                {   
                    echo "<p> Message Failed. </p>";
                }
            }
        }

        public function ReminderEmail($limit)
        {
            $users = User::where('user_type', 'online')->where('rem_email_send', 0)->where('email','!=','')->limit($limit)->get();

            foreach ($users as $user)
            {
                $body = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'qrcode_path' => $user->qrcode_path,
                    'eticket_path' => $user->eticket_path,
                ];

                Mail::to($user->email)->send(new OnlineRegisterEmail($body));
                if(Mail::failures() != 0)
                {                
                    User::where('id', $user->id)->update(['rem_email_send' => 1]);
                    echo "<p> Message Sent. </p>";
                }
                else
                {   
                    echo "<p> Message Failed. </p>";
                }
            }

        }

        public function FeedbackEmail($limit)
        {
            $zpping_users = DB::table('entry_zapping')->where('email_send', 0)->limit($limit)->get();

            //dd($zpping_users);

            foreach ($zpping_users as $codes)
            {
                $users = User::where('unique_code', $codes->unique_code)->where('feed_email_send', 0)->first();
                
                $body = [
                    'name' => $users->name,
                    'email' => $users->email,
                    'link_email' => base64_encode($users->id),
                ];

                Mail::to($users->email)->send(new FeedbackEmail($body));

                if(Mail::failures() != 0)
                {                
                    DB::table('entry_zapping')->where('unique_code', $codes->unique_code)->update(['email_send' => 1]);
                    User::where('id', $users->id)->update(['feed_email_send' => 1]);

                    echo "<p> Message Sent. </p>";
                }
                else
                {   
                    echo "<p> Message Failed. </p>";
                }
            }

        }
    }

?>