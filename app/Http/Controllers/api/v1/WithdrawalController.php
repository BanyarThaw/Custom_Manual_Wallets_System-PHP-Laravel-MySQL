<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Point;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WithdrawalController extends Controller
{
    public function send_withdrawal(Request $request) {
        $validator = Validator::make($request->all(),[
            'payment_id' => 'required|exists:payment_providers,id',
            'user_id' => 'required',
            'total_points' => 'required|numeric',
            'user_account' => 'required|numeric', 
        ]);

        // if validation fails
        if($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'something went wrong.',
                'error' =>  $validator->messages()
            ],400);
        }

        // calculate money amount
        $point_value = Point::latest()->first();
        $amount = $point_value->value*$request->total_points;

        Withdrawal::create([
            'payment_id' => $request->payment_id,
            'user_id' => $request->user_id,
            'amount' => $amount,
            'user_account' => $request->user_account,
            'status' => 0,
            'total_points' => $request->total_points,
            'point_value' => $point_value->value,
        ]);

        return response([
            'success' => true,
            'message' => 'Withdrawal Request sent successfully.We will response as soon as possible.'
        ],200);
    }  
    
    public function history(Request $request) {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:withdrawals,user_id', 
        ]);

        // if validation fails
        if($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'something went wrong.',
                'error' =>  $validator->messages()
            ],400);
        }

        $history = Withdrawal::where('user_id',$request->user_id)->orderBy('created_at','desc')->paginate(15);
        return response()->withdrawalHistory($history);
    }
}
