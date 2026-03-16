<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeItem;
class AdminHomeItemController extends Controller
{
    public function index(){
        $home_item = HomeItem::firstOrCreate(
            ['id' => 1],
            [
                'destination_heading' => 'Discover Our Destinations',
                'destination_subheading' => 'Explore the world with us',
                'destination_status' => 'Show',
                'feature_status' => 'Show',
                'package_heading' => 'Our Packages',
                'package_subheading' => 'Choose your package',
                'package_status' => 'Show',
                'testimonial_heading' => 'What Our Clients Say',
                'testimonial_subheading' => 'See what our clients have to say',
                'testimonial_background' => null,
                'testimonial_status' => 'Show',
                'blog_heading' => 'Latest Blog Posts',
                'blog_subheading' => 'Read our latest blog posts',
                'blog_status' => 'Show',
            ]
        );
        return view('admin.home_item.index', compact('home_item'));
    }

    public function update(Request $request){

        $request->validate([
            'destination_heading' => 'required',
            'destination_subheading' => 'required',
            
            'package_heading' => 'required',
            'package_subheading' => 'required',
            
            'testimonial_heading' => 'required',
            'testimonial_subheading' => 'required',
                        
            'blog_heading' => 'required',
            'blog_subheading' => 'required',            
        ]);

        $obj = HomeItem::where('id', 1)->first();
        if (!$obj) {
            $obj = HomeItem::create(['id' => 1]);
        }

        if ($request->hasFile('testimonial_background')) {
            $request->validate([
                'testimonial_background' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $obj->testimonial_background = 'testimonial_background_' . time() . '.' . $request->testimonial_background->extension();
            $request->testimonial_background->move(public_path('uploads'), $obj->testimonial_background);
        }

        $obj->destination_heading = $request->destination_heading;
        $obj->destination_subheading = $request->destination_subheading;
        $obj->destination_status = $request->destination_status ?? 'Show';
        $obj->feature_status = $request->feature_status ?? 'Show';
        $obj->package_heading = $request->package_heading;
        $obj->package_subheading = $request->package_subheading;
        $obj->package_status = $request->package_status ?? 'Show';
        $obj->testimonial_heading = $request->testimonial_heading;
        $obj->testimonial_subheading = $request->testimonial_subheading;
        $obj->testimonial_status = $request->testimonial_status ?? 'Show';
        $obj->blog_heading = $request->blog_heading;
        $obj->blog_subheading = $request->blog_subheading;
        $obj->blog_status = $request->blog_status ?? 'Show';

        $obj->save();

        return redirect()->route('admin_home_item_index')->with('success', 'Home Item Updated Successfully');
    }
}
