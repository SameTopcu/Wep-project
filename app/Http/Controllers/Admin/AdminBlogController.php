<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategories;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Post;

class AdminBlogController extends Controller
{
    public function index(){
        $blog_categories=BlogCategories::get();
        return view('admin.blog_category.index',compact('blog_categories'));
    }

    public function create(){
        
        return view('admin.blog_category.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'slug'         => 'required|alpha_dash|unique:blog_categories',
        ]);
    
        $obj = new BlogCategories();
        $obj->name = $request->name;
        $obj->slug = $request->slug;
        $obj->save();
    
        return redirect()
            ->route('admin_blog_category_index')
            ->with('success', 'Blog Category Created Successfully');
    }

    public function edit($id){
        $blog_category = BlogCategories::where('id',$id)->first();
        return view('admin.blog_category.edit',compact('blog_category'));
    }

    public function edit_submit(Request $request,$id){
        $obj = BlogCategories::where('id',$id)->first();

        $request->validate([
            'name'=> 'required',
            'slug'=> 'required|alpha_dash|unique:blog_categories,slug,'.$id,
        ]);

        $obj->name = $request->name;
        $obj->slug = $request->slug;
        $obj->save();
        return redirect()->route('admin_blog_category_index')->with('success','Blog Category is Updated Successfully');
    }

    public function delete($id){
        $total=Post::where('blog_category_id',$id)->count();
        if($total>0){
            return redirect()->route('admin_blog_category_index')->with('error','Blog Category is associated with posts. So, it cannot be deleted.');
        }
        $obj = BlogCategories::where('id',$id)->first();
        $obj->delete();
        return redirect()->route('admin_blog_category_index')->with('success','Blog Category is Deleted Successfully');
    }
}
