<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\BlogCategories;

class AdminPostController extends Controller
{
    public function index(){
        $posts=Post::get();
        return view('admin.post.index',compact('posts'));
    }

    public function create(){
        $blog_categories=BlogCategories::get();
        return view('admin.post.create',compact('blog_categories'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|alpha_dash|unique:posts',
            'short_description' => 'required',
            'description' => 'required',
            'blog_category_id' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $final_name = 'post_' . time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
    
        $obj = new Post();
        $obj->photo = $final_name;
        $obj->title = $request->title;
        $obj->slug = $request->slug;
        $obj->short_description = $request->short_description;
        $obj->description = $request->description;
        $obj->blog_category_id = $request->blog_category_id;
        $obj->save();

        return redirect()
            ->route('admin_post_index')
            ->with('success', 'Post Created Successfully');
    }

    public function edit($id){
        $post = Post::find($id);
        $blog_categories=BlogCategories::get();
        return view('admin.post.edit',compact('post','blog_categories'));
    }

    public function edit_submit(Request $request,$id){

        $post = Post::find($id);
        $request->validate([
            'title' => 'required',
            'slug' => 'required|alpha_dash|unique:posts,slug,'.$id,
            'short_description' => 'required',
            'description' => 'required',
            'blog_category_id' => 'required',
            
        ]);

        if($request->hasFile('photo')){
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            unlink(public_path('uploads/'.$post->photo));
            $final_name = 'post_' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $post->photo = $final_name;
        }
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->blog_category_id = $request->blog_category_id;
        $post->save();
        return redirect()->route('admin_post_index')->with('success','Post Updated Successfully');
    }

    public function delete($id)
{
    $post = Post::findOrFail($id);

    if($post->photo && file_exists(public_path('uploads/'.$post->photo))) {
        unlink(public_path('uploads/'.$post->photo));
    }

    $post->delete();

    return redirect()
        ->route('admin_post_index')
        ->with('success', 'Post is Deleted Successfully');
}
}
