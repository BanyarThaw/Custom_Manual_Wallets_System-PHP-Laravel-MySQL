<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function point() {
        $point = Point::latest()->first();

        return response()->json([
            'success' => true,
            'point value' => $point->value,
        ],200);
    }
}
