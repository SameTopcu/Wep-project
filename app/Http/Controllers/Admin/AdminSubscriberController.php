<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;
class AdminSubscriberController extends Controller
{

    public function subscribers(){
        $subscribers = Subscriber::get();
        return view('admin.subscriber.index',compact('subscribers'));
    }

    public function send_email(){
        return view('admin.subscriber.send_email');
    }

    public function send_email_submit(Request $request){
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);
        $subscribers = Subscriber::where('status','Active')->get();
        foreach($subscribers as $subscriber){
        $subject = $request->subject;
        $message = $request->message;
        $email = $subscriber->email;
        Mail::to($email)->send(new Websitemail($subject, $message));
        }
        return redirect()->back()->with('success','Email sent successfully');
    }

    public function subscriber_delete($id){
        $subscriber = Subscriber::find($id);
        $subscriber->delete();
        return redirect()->back()->with('success','Subscriber deleted successfully');
    }
}
