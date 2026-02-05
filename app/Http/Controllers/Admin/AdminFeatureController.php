<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class AdminFeatureController extends Controller
{
    
    public function index(){
        $features=Feature::get();
        return view('admin.feature.index',compact('features'));
    }

    public function create(){
        
        return view('admin.feature.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'header'      => 'required',
            'description'         => 'required',
            'icon'        => 'required',
        ]);
    
        $obj = new Feature();
        $obj->icon = $request->icon;
        $obj->header = $request->header;
        $obj->description = $request->description;
        $obj->save();
    
        return redirect()
            ->route('admin_feature_index')
            ->with('success', 'Feature Created Successfully');
    }

    public function edit($id){
        $feature = Feature::where('id',$id)->first();
        return view('admin.feature.edit',compact('feature'));
    }

    public function edit_submit(Request $request,$id){
        $obj = Feature::where('id',$id)->first();

        $request->validate([
            'header'      => 'required',
            'description'         => 'required',
            'icon'        => 'required',
        ]);

        $obj->icon = $request->icon;
        $obj->header = $request->header;
        $obj->description = $request->description;
        $obj->save();
        return redirect()->route('admin_feature_index')->with('success','Feature Updated Successfully');
    }

    public function delete($id){
        $obj = Feature::where('id',$id)->first();
        $obj->delete();
        return redirect()->route('admin_feature_index')->with('success','Feature Deleted Successfully');
    }

}

