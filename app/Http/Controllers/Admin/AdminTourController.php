<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Packages;

class AdminTourController extends Controller
{
    public function index(){
        $tours=Tour::get();
        return view('admin.tour.index',compact('tours'));
    }

    public function create(){

        $packages=Packages::orderBy('name','asc')->get();
        return view('admin.tour.create',compact('packages'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'tour_start_date'         => 'required',
            'end_date'         => 'required',
            'booking_end_date'         => 'required',
            'tour_total_seat'         => 'required',
        ]);
    
        $obj = new Tour();
        $obj->package_id = $request->package_id;
        $obj->tour_start_date = $request->tour_start_date;
        $obj->end_date = $request->end_date;
        $obj->booking_end_date = $request->booking_end_date;
        $obj->tour_total_seat = $request->tour_total_seat;
        $obj->save();
    
        return redirect()
            ->route('admin_tour_index')
            ->with('success', 'Tour Created Successfully');
    }

    public function edit($id){
        $tour = Tour::where('id',$id)->first();
        $packages=Packages::orderBy('name','asc')->get();
        return view('admin.tour.edit',compact('tour','packages'));
    }

    public function edit_submit(Request $request,$id){
        $obj = Tour::where('id',$id)->first();

        $request->validate([
            'package_id'      => 'required',
            'tour_start_date' => 'required',
            'end_date'        => 'required',
            'booking_end_date'=> 'required',
            'tour_total_seat' => 'required','numeric',
        ]);

        $obj->package_id = $request->package_id;
        $obj->tour_start_date = $request->tour_start_date;
        $obj->end_date = $request->end_date;
        $obj->booking_end_date = $request->booking_end_date;
        $obj->tour_total_seat = $request->tour_total_seat;
        $obj->save();
        return redirect()->route('admin_tour_index')->with('success','Tour is Updated Successfully');
    }

    public function delete($id){
        $obj =Tour::where('id',$id)->first();
        $obj->delete();
        return redirect()->route('admin_tour_index')->with('success','Tour is Deleted Successfully');
    }
}
