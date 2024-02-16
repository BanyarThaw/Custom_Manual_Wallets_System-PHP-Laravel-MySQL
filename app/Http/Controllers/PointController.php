<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function index() {
        $current_point_value = Point::latest()->first();

        $data = Point::latest()->paginate(20);

        return view('points.index',compact('current_point_value','data'));       
    }

    public function form() {
        return view('points.change');
    }

    public function change(Request $request) {
        request()->validate([
            'value' => 'required'
        ]);

        $point = new Point();
        
        $point->point = 1;
        $point->value = $request->value;
        $point->save();
        
        return redirect()->route('points.index')->with('info','Point value changed successfully.');
    }
}
