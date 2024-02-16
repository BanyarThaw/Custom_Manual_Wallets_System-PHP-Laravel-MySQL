<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Point;
use App\Models\Deposit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    public function send_deposit(Request $request) {
        $validator = Validator::make($request->all(),[
            'payment_id' => 'required|exists:payment_providers,id',
            'user_id' => 'required',
            'amount' => 'required|integer',
            'user_account' => 'required|numeric',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg' 
        ]);

        $fileName= Str::random(20).$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('payment-receipts',$fileName,'public');

        // if validation fails
        if($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'something went wrong.',
                'error' =>  $validator->messages()
            ],400);
        }

        // calculate total points
        $point_value = Point::latest()->first();

        $total_points = number_format((float)$request->amount/$point_value->value, 2, '.', ''); // only 2 decimal places

        Deposit::create([
            'payment_id' => $request->payment_id,
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'user_account' => $request->user_account,
            'photo' => $path,
            'status' => 0,
            'total_points' => $total_points,
            'point_value' => $point_value->value,
        ]);

        return response([
            'success' => true,
            'message' => 'Deposit Request sent successfully.We will response as soon as possible.'
        ],200);
    }

    public function history(Request $request) {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:deposits,user_id', 
        ]);

        // if validation fails
        if($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'something went wrong.',
                'error' =>  $validator->messages()
            ],400);
        }

        $history = Deposit::where('user_id',$request->user_id)->orderBy('created_at','desc')->paginate(15);
        return response()->depositHistory($history);
    }
}
