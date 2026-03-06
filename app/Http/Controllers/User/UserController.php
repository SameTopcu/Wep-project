<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Admin;   
use App\Models\Review;
class UserController extends Controller
{
    public function dashboard(){
        $total_completed_orders = Booking::where('user_id', Auth::guard('web')->user()->id)->where('payment_status', 'COMPLETED')->count();
        $total_pending_orders = Booking::where('user_id', Auth::guard('web')->user()->id)->where('payment_status', 'PENDING')->count();



        return view('user.dashboard',compact('total_completed_orders','total_pending_orders'));
    }

    public function booking(){
        $all_data = Booking::with(['user', 'tour', 'package'])->where('user_id', Auth::guard('web')->user()->id)->get();
        return view('user.booking',compact('all_data'));
    }

    public function invoice($invoice_no){
        $admin_data=Admin::where('id',1)->first();
        $booking = Booking::with(['user', 'tour', 'package'])->where('invoice_no', $invoice_no)->first();
        return view('user.invoice',compact('booking','invoice_no','admin_data'));
    }

    public function review(){
        $reviews = Review::with(['user', 'package.destination'])->where('user_id', Auth::guard('web')->user()->id)->get();
        return view('user.review',compact('reviews'));
    }
    

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success','Logout is successfull');
    }

    public function profile(){  
        return view('user.profile');
    }

    public function profile_submit(Request $request){

        $user = User::where('id',Auth::guard('web')->user()->id)->first();

            $request->validate([
                'name'=>'required',
                'email'=>'required|email|unique:users,email,'.$user->id,
                'phone'=>'required',
                'country=>required',
                'address'=>'required',
                'state'=>'required',
                'city'=>'required',
                'zip'=>'required',

                ]);

                if($request->photo){
                    $request->validate([
                        'photo'=> 'image|mimes:jpeg,png,jpg,gid,svg|max:2048',
                    ]);
                    $final_name='user_'.time().'.'.$request->photo->extension();
                    $request->photo->move(public_path('uploads'),$final_name);
                    $user->photo = $final_name;

                }

                if($request->password != ''){
                    $request->validate([
                        'password'=> 'required',
                        'retype_password'=>'required|same:password',
                        ]);
                        $user->password = bcrypt($request->password);
                }


                $user->name = $request->name;
                $user->email = $request->email;
                $user->address =$request->address;
                $user->phone = $request->phone;
                $user->country = $request->country;
                $user->state = $request->state;
                $user->zip = $request->zip;
                $user->city =$request->city;

                $user->save();


                return redirect()->back()->with('success','Profil başarıyla güncellenmiştir.');
    }

}