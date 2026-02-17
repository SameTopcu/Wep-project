<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Models\Destination;
use App\Models\PackageAmenity;
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
    
    //$total_photos=DestinationPhoto::where('destination_id',$id)->count();
    //
    //if($total_photos>0){
    //    return redirect()->route('admin_destination_index')->with('error','Destination has photos. So, it cannot be deleted.');
    //}

    //$total_videos=DestinationVideo::where('destination_id',$id)->count();
    //if($total_videos>0){
    //    return redirect()->route('admin_destination_index')->with('error','Destination has videos. So, it cannot be deleted.');
    //}
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
}
