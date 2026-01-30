<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(){
        return view('user.dashboard');
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
                'email'=>'required',
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