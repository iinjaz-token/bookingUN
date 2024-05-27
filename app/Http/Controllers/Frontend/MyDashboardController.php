<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MyDashboardController extends Controller
{
    public function LoadMyDashboard()
    {
        return view('frontend.my-dashboard');
    }
    
    public function LoadMyBooking()
    {
        $userid = 0;
        if (isset(Auth::user()->id)) {
            $userid = Auth::user()->id;
        }

        $datalist = DB::table('booking_manages')
            ->join('rooms', 'booking_manages.roomtype_id', '=', 'rooms.id')
            ->join('payment_method', 'booking_manages.payment_method_id', '=', 'payment_method.id')
            ->join('payment_status', 'booking_manages.payment_status_id', '=', 'payment_status.id')
            ->join('booking_status', 'booking_manages.booking_status_id', '=', 'booking_status.id')
            ->select('booking_manages.*', 'rooms.title', 'rooms.old_price', 'rooms.is_discount', 
             'payment_method.method_name', 'payment_status.pstatus_name', 'booking_status.bstatus_name')
            ->where('booking_manages.customer_id', '=', $userid)
            ->orderBy('booking_manages.id', 'desc')
            ->paginate(10);

        return view('frontend.my-booking', compact('datalist'));
    }

    public function LoadMyProfile()
    {
        return view('frontend.my-profile');
    }
    
    public function UpdateProfile(Request $request)
    {
        $gtext = gtext();
        
        $id = $request->input('user_id');
        
        $secretkey = $gtext['secretkey'];
        $recaptcha = $gtext['is_recaptcha'];
        if ($recaptcha == 1) {
            $request->validate([
                'g-recaptcha-response' => 'required',
                'name' => 'required',
                'email' => 'required',
            ]);

            $captcha = $request->input('g-recaptcha-response');

            $ip = $_SERVER['REMOTE_ADDR'];
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urlencode($secretkey).'&response='.urlencode($captcha).'&remoteip'.$ip;
            $response = file_get_contents($url);
            $responseKeys = json_decode($response, true);
            if ($responseKeys["success"] == false) {
                return redirect("user/register")->withFail(__('The recaptcha field is required'));
            }
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);
        }

        $data = array(
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address')
        );

        $response = User::where('id', $id)->update($data);
        
        if ($response) {
            return redirect()->back()->withSuccess(__('Updated Successfully'));
        } else {
            return redirect()->back()->withFail(__('Data update failed'));
        }
    }
    
    public function LoadChangePassword()
    {
        return view('frontend.change-password');
    }
    
    public function ChangePassword(Request $request)
    {
        $gtext = gtext();

        $secretkey = $gtext['secretkey'];
        $recaptcha = $gtext['is_recaptcha'];
        if ($recaptcha == 1) {
            $request->validate([
                'g-recaptcha-response' => 'required',
                'current_password' => 'required',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required'
            ]);

            $captcha = $request->input('g-recaptcha-response');

            $ip = $_SERVER['REMOTE_ADDR'];
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urlencode($secretkey).'&response='.urlencode($captcha).'&remoteip'.$ip;
            $response = file_get_contents($url);
            $responseKeys = json_decode($response, true);
            if ($responseKeys["success"] == false) {
                return redirect("user/register")->withFail(__('The recaptcha field is required'));
            }
        } else {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required'
            ]);
        }

       $hashedPassword = Auth::user()->password;
 
       if (\Hash::check($request->input('current_password'), $hashedPassword )) {
 
            if (!\Hash::check($request->input('password'), $hashedPassword)) {

                $id = Auth::user()->id;

                $data = array(
                    'password' => Hash::make($request->input('password')),
                    'bactive' => base64_encode($request->input('password'))
                );
                
                $response = User::where('id', $id)->update($data);
                
                if ($response) {
                    return redirect()->back()->withSuccess(__('Your password changed successfully'));
                } else {
                    return redirect()->back()->withFail(__('Oops! You are failed to change password. Please try again'));
                }
            } else {
                
                return redirect()->back()->withFail(__('New password can not be the old password!'));
            }
 
        } else {
            return redirect()->back()->withFail(__('Current password does not match.'));
        }
    }
}
