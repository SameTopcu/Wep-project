<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Models\Destination;
use App\Models\PackageAmenity;
use App\Models\PackageItinerary;
use App\Models\PackagePhoto;
use App\Models\PackageVideo;
use App\Models\PackageFaq;
use App\Models\Tour;
class AdminPackagesController extends Controller
{
    public function index(){
        
        $destinations=Destination::orderBy('name','asc')->get();
        $packages=Packages::get();
        return view('admin.package.index',compact('packages','destinations'));
    }

    public function create(){

        $destinations=Destination::orderBy('name','asc')->get();
        return view('admin.package.create',compact('destinations'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:destinations',
            'price' =>'required|numeric',
            'old_price' =>'numeric',
            'description'=>'required',
            'featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $final_name = 'destination_featured_' . time() . '.' . $request->featured_photo->extension();
        $request->featured_photo->move(public_path('uploads'), $final_name);

        $final_name_banner = 'package_banner_' . time() . '.' . $request->banner->extension();
        $request->banner->move(public_path('uploads'), $final_name_banner);
    
        $obj = new Packages();
        $obj->destination_id = $request->destination_id;
        $obj->featured_photo = $final_name;
        $obj->name = $request->name;
        $obj->slug = $request->slug;
        $obj->description = $request->description;
        $obj->map = $request->map;
        $obj->price = $request->price;
        $obj->old_price = $request->old_price;
        $obj->banner = $final_name_banner;
        $obj->save();

        return redirect()
            ->route('admin_package_index')
            ->with('success', 'Packages Information Created Successfully');
    }

    public function edit($id){
        $package = Packages::where('id',$id)->first();
        $destinations=Destination::orderBy('name','asc')->get();
        return view('admin.package.edit',compact('package','destinations'));
    }

    public function edit_submit(Request $request, $id)
{
    $package = Packages::findOrFail($id); 

    $request->validate([
        'name' => 'required',
        'slug' => 'required|alpha_dash|unique:packages,slug,'.$id,
        'price' => 'required|numeric',
        'old_price' => 'numeric|nullable',
        'description' => 'required',
        'featured_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if($request->hasFile('featured_photo')) {
        if($package->featured_photo && file_exists(public_path('uploads/'.$package->featured_photo))) {
            unlink(public_path('uploads/'.$package->featured_photo));
        }

        $final_name = 'package_featured_' . time() . '.' . $request->featured_photo->extension();
        $request->featured_photo->move(public_path('uploads'), $final_name);
        $package->featured_photo = $final_name;
    }

    if($request->hasFile('banner')) {
        if($package->banner && file_exists(public_path('uploads/'.$package->banner))) {
            unlink(public_path('uploads/'.$package->banner));
        }

        $final_name_banner = 'package_banner_' . time() . '.' . $request->banner->extension();
        $request->banner->move(public_path('uploads'), $final_name_banner);
        $package->banner = $final_name_banner;
    }
    $package->destination_id = $request->destination_id;
    $package->name = $request->name;
    $package->slug = $request->slug;
    $package->description = $request->description;
    $package->map = $request->map;
    $package->price = $request->price;
    $package->old_price = $request->old_price;

    $package->save();

    return redirect()->route('admin_package_index')->with('success','Package Updated Successfully');
}
    

    public function delete($id)
    {
    
    
    $total_itineraries=PackageItinerary::where('package_id',$id)->count();
    if($total_itineraries>0){
        return redirect()->route('admin_package_index')->with('error','Package has itineraries. So, it cannot be deleted.');
    }

    $total_videos=PackageVideo::where('package_id',$id)->count();
    if($total_videos>0){
        return redirect()->route('admin_package_index')->with('error','Package has videos. So, it cannot be deleted.');
    }
    
    $total_photos=PackagePhoto::where('package_id',$id)->count();
    
    if($total_photos>0){
        return redirect()->route('admin_package_index')->with('error','Package has photos. So, it cannot be deleted.');
    }

    $total_amenities=PackageAmenity::where('package_id',$id)->count();
    if($total_amenities>0){
        return redirect()->route('admin_package_index')->with('error','Package has amenities. So, it cannot be deleted.');
    }

    $total_faqs=PackageFaq::where('package_id',$id)->count();
    if($total_faqs>0){
        return redirect()->route('admin_package_index')->with('error','Package has faqs. So, it cannot be deleted.');
    }

    $total_tours=Tour::where('package_id',$id)->count();
    if($total_tours>0){
        return redirect()->route('admin_package_index')->with('error','Package has tours. So, it cannot be deleted.');
    }
    
    $package = Packages::findOrFail($id);

    if($package->featured_photo && file_exists(public_path('uploads/'.$package->featured_photo))) {
        unlink(public_path('uploads/'.$package->featured_photo));
    }
    if($package->banner && file_exists(public_path('uploads/'.$package->banner))) {
        unlink(public_path('uploads/'.$package->banner));
    }

    $package->delete();

    return redirect()
        ->route('admin_package_index')
        ->with('success', 'Package is Deleted Successfully');
    }

    public function package_amenities($id){
        
        $package_amenities=PackageAmenity::where('package_id',$id)->get();
        $package = Packages::where('id',$id)->first(); 
        $amenities=Amenity::orderBy('name','asc')->get();
        return view('admin.package.amenities',compact('package','package_amenities','amenities'));
    }

    public function amenities_submit(Request $request, $id)
    {
        $request->validate([
            'amenity_id' => 'required',
            'type' => 'required',
        ]);

        $obj = new PackageAmenity();
        $obj->package_id = $id;
        $obj->amenity_id = $request->amenity_id;
        $obj->type = $request->type;
        $obj->save();

        return redirect()->route('admin_package_amenities', $id)->with('success', 'Amenity Added Successfully');
    }

    public function amenities_delete($id)
    {
        $package_amenity = PackageAmenity::findOrFail($id);
        $package_id = $package_amenity->package_id;
        $package_amenity->delete();

        return redirect()->route('admin_package_amenities', $package_id)->with('success', 'Amenity Deleted Successfully');
    }

    public function package_itineraries($id){
        
        $package_itineraries=PackageItinerary::where('package_id',$id)->get();
        $package = Packages::where('id',$id)->first(); 
        return view('admin.package.itineraries',compact('package','package_itineraries'));
    }

    public function itineraries_submit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $obj = new PackageItinerary();
        $obj->package_id = $id;
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->save();

        return redirect()->route('admin_package_itineraries', $id)->with('success', 'Itinerary Added Successfully');
    }

    public function itineraries_delete($id)
    {
        $package_itinerary = PackageItinerary::findOrFail($id);
        $package_id = $package_itinerary->package_id;
        $package_itinerary->delete();

        return redirect()->route('admin_package_itineraries', $package_id)->with('success', 'Itinerary is Deleted Successfully');
    }


    public function package_photos($id){
        
        $package_photos=PackagePhoto::where('package_id',$id)->get();
        $package = Packages::where('id',$id)->first(); 
        return view('admin.package.photos',compact('package','package_photos'));
    }

    public function photos_submit(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $final_name = 'package_photo_' . time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);

        $obj = new PackagePhoto();
        $obj->package_id = $id;
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->route('admin_package_photos', $id)->with('success', 'Photo Added Successfully');
    }

    public function photos_delete($id)
    {
        $package_photo = PackagePhoto::findOrFail($id);
        $package_id = $package_photo->package_id;
        $package_photo->delete();

        if($package_photo->photo && file_exists(public_path('uploads/'.$package_photo->photo))) {
            unlink(public_path('uploads/'.$package_photo->photo));
        }

        return redirect()->route('admin_package_photos', $package_id)->with('success', 'Photo is Deleted Successfully');
    }


    public function package_videos($id){
        
        $package_videos=PackageVideo::where('package_id',$id)->get();
        $package = Packages::where('id',$id)->first(); 
        return view('admin.package.videos',compact('package','package_videos'));
    }

    public function videos_submit(Request $request, $id)
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

        $obj = new PackageVideo();
        $obj->package_id = $id;
        $obj->video = $videoId;
        $obj->save();
        return redirect()->route('admin_package_videos', $id)->with('success', 'Video Added Successfully');
    }

    public function videos_delete($id)
    {
        $package_video = PackageVideo::findOrFail($id);
        $package_id = $package_video->package_id;
        $package_video->delete();

        if($package_video->video && file_exists(public_path('uploads/'.$package_video->video))) {
            unlink(public_path('uploads/'.$package_video->video));
        }

        return redirect()->route('admin_package_videos', $package_id)->with('success', 'Video is Deleted Successfully');
    }

    public function package_faqs($id){
        $package_faqs=PackageFaq::where('package_id',$id)->get();
        $package = Packages::where('id',$id)->first(); 
        return view('admin.package.faqs',compact('package','package_faqs'));
    }

    public function faqs_submit(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $obj = new PackageFaq();
        $obj->package_id = $id;
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        $obj->save();
        return redirect()->route('admin_package_faqs', $id)->with('success', 'FAQ Added Successfully');
    }

    public function faqs_delete($id)
    {
        $package_faq = PackageFaq::findOrFail($id);
        $package_id = $package_faq->package_id;
        $package_faq->delete();
        return redirect()->route('admin_package_faqs', $package_id)->with('success', 'FAQ is Deleted Successfully');
    }


}
