<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\DestinationPhoto;
use App\Models\DestinationVideo;
class AdminDestinationController extends Controller
{
    public function index(){
        $destinations=Destination::get();
        return view('admin.destination.index',compact('destinations'));
    }

    public function create(){
        
        return view('admin.destination.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:destinations',
            'description' => 'required',
            'featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $final_name = 'destination_featured_' . time() . '.' . $request->featured_photo->extension();
        $request->featured_photo->move(public_path('uploads'), $final_name);
    
        $obj = new Destination();
        $obj->featured_photo = $final_name;
        $obj->name = $request->name;
        $obj->slug = $request->slug;
        $obj->description = $request->description;
        $obj->map = $request->map;
        $obj->view_count = $request->view_count;
        $obj->country = $request->country;
        $obj->language = $request->language;
        $obj->currency = $request->currency;
        $obj->area = $request->area;
        $obj->time_zone = $request->time_zone;
        $obj->visa_requirement = $request->visa_requirement;
        $obj->best_time = $request->best_time;
        $obj->health_safety = $request->health_safety;
        $obj->activity = $request->activity;
        $obj->view_count = 0;
        $obj->save();

        return redirect()
            ->route('admin_destination_index')
            ->with('success', 'Destination Information Created Successfully');
    }

    public function edit($id){
        $destination = Destination::find($id);
        return view('admin.destination.edit',compact('destination'));
    }

    public function edit_submit(Request $request, $id)
{
    $destination = Destination::findOrFail($id); 

    $request->validate([
        'name' => 'required',
        'slug' => 'required|alpha_dash|unique:destinations,slug,'.$id, 
        'description' => 'required',
        'featured_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
    ]);

    if($request->hasFile('featured_photo')) {
        if($destination->featured_photo && file_exists(public_path('uploads/'.$destination->featured_photo))) {
            unlink(public_path('uploads/'.$destination->featured_photo));
        }

        $final_name = 'destination_featured_' . time() . '.' . $request->featured_photo->extension();
        $request->featured_photo->move(public_path('uploads'), $final_name);
        $destination->featured_photo = $final_name;
    }

    $destination->name = $request->name;
    $destination->slug = $request->slug;
    $destination->description = $request->description;
    $destination->view_count = $request->view_count ?? 0;
    $destination->map = $request->map; 
    $destination->country = $request->country;
    $destination->language = $request->language;
    $destination->currency = $request->currency;
    $destination->area = $request->area;
    $destination->time_zone = $request->time_zone;
    $destination->visa_requirement = $request->visa_requirement;
    $destination->best_time = $request->best_time;
    $destination->health_safety = $request->health_safety;
    $destination->activity = $request->activity;

    $destination->save();

    return redirect()->route('admin_destination_index')->with('success','Destination Updated Successfully');
}
    

    public function delete($id)
    {
    
    $total_photos=DestinationPhoto::where('destination_id',$id)->count();
    
    if($total_photos>0){
        return redirect()->route('admin_destination_index')->with('error','Destination has photos. So, it cannot be deleted.');
    }

    $total_videos=DestinationVideo::where('destination_id',$id)->count();
    if($total_videos>0){
        return redirect()->route('admin_destination_index')->with('error','Destination has videos. So, it cannot be deleted.');
    }
    $destination = Destination::findOrFail($id);

    if($destination->featured_photo && file_exists(public_path('uploads/'.$destination->featured_photo))) {
        unlink(public_path('uploads/'.$destination->featured_photo));
    }

    $destination->delete();

    return redirect()
        ->route('admin_destination_index')
        ->with('success', 'Destination is Deleted Successfully');
    }
    
    public function destination_photos($id){
        
        $destination_photos=DestinationPhoto::where('destination_id',$id)->get();
        $destination = Destination::where('id',$id)->first(); 
        return view('admin.destination.photos',compact('destination','destination_photos'));
    }

    public function destination_photo_submit(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $final_name = 'destination_' . time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);

        $obj = new DestinationPhoto();
        $obj->destination_id = $id;
        $obj->photo = $final_name;
        $obj->save();
        return redirect()->route('destination_photos',$id)->with('success','Photo Uploaded Successfully');
    }

    public function destination_photo_delete($id)
    {
        $destination_photo = DestinationPhoto::findOrFail($id);
        $destination_photo->delete();
        if($destination_photo->photo && file_exists(public_path('uploads/'.$destination_photo->photo))) {
            unlink(public_path('uploads/'.$destination_photo->photo));
        }
        return redirect()->route('destination_photos',$destination_photo->destination_id)->with('success','Photo Deleted Successfully');
    }

    public function destination_videos($id){

        $destination_videos=DestinationVideo::where('destination_id',$id)->get();
        $destination = Destination::where('id',$id)->first();
        return view('admin.destination.videos',compact('destination','destination_videos'));
    }


    public function destination_video_submit(Request $request, $id)
    {
        $request->validate([
            'video' => 'required',
        ]);

        $raw = trim($request->video);
        if (preg_match('/(?:youtube\.com\/(?:watch\?.*v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $raw, $m)) {
            $videoId = $m[1];
        } else {
            $videoId = strtok($raw, '?');
        }

        $obj = new DestinationVideo();
        $obj->destination_id = $id;
        $obj->video = $videoId;
        $obj->save();
        return redirect()->route('destination_videos',$id)->with('success','Video Uploaded Successfully');
    }

    public function destination_video_delete($id)
    {
        $destination_video = DestinationVideo::findOrFail($id);
        $destination_video->delete();
        if($destination_video->video && file_exists(public_path('uploads/'.$destination_video->video))) {
            unlink(public_path('uploads/'.$destination_video->video));
        }
        return redirect()->route('destination_videos',$destination_video->destination_id)->with('success','Video Deleted Successfully');
    }

}