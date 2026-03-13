<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\MessageComment;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function message(){
        $messages = Message::with('user')->orderBy('id','desc')->get();
        return view('admin.user.message',compact('messages'));
    }

    public function message_detail($id){
        $message = Message::with('user')->find($id);
        $message_comments = MessageComment::where('message_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.user.message_detail', compact('message', 'message_comments'));
    }

    public function message_reply(Request $request, $id){
        $request->validate([
            'comment' => 'required',
        ]);

        $object = new MessageComment();
        $object->message_id = $id;
        $object->sender_id = Auth::guard('admin')->user()->id;
        $object->comment = $request->comment;
        $object->type = 'admin';
        $object->save();

        $message = Message::with('user')->find($id);
        $user = $message->user;
        $admin = Auth::guard('admin')->user();
        $subject = 'Reply from ' . $admin->name;
        $body = '<b>From:</b> ' . $admin->name . ' (Admin)<br><br>'
              . '<b>Message:</b><br>' . nl2br(e($request->comment));
        Mail::to($user->email)->send(new Websitemail($subject, $body));

        return redirect()->back()->with('success', 'Reply sent successfully.');
    }
}
