<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WelcomeItem;
class AdminWelcomeItemController extends Controller
{
    public function index()
    {
        $welcome_item = WelcomeItem::where('id', 1)->first();
        return view('admin.welcome.index', compact('welcome_item'));
    }

    public function update(Request $request){

        $obj = WelcomeItem::where('id', 1)->first();

        $request->validate([
            'heading' => 'required',
            'description' => 'required',
            'video' => 'required',
            'button_text' => 'required',
            'button_link' => 'required',
        ]);

        if($request->hasFile('photo')){
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            // Eski fotoğrafı sadece varsa ve dosya ise sil
            if (!empty($obj->photo)) {
                $old_path = public_path('uploads/' . $obj->photo);
                if (is_file($old_path)) {
                    unlink($old_path);
                }
            }
            $final_name = 'welcome_item_' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $obj->photo = $final_name;
        }

        $obj->heading = $request->heading;
        $obj->description = $request->description;
        $obj->video = $request->video;
        $obj->button_text = $request->button_text;
        $obj->button_link = $request->button_link;
        $obj->status = $request->status;
        $obj->save();

        return redirect()->route('admin_welcome_item_index')->with('success', 'Welcome Item Updated Successfully');
    }
    
}
