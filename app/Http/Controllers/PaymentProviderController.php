<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentProviderRequest;
use App\Http\Requests\UpdatePaymentProviderRequest;
use App\Models\PaymentProvider;
use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    public function index() {
        $data = PaymentProvider::where('status','=',0)->orderBy('created_at','desc')->paginate(10);
        return view('payments.index',compact('data'));
    }

    public function removed_list() {
        $data = PaymentProvider::where('status','=',1)->orderBy('created_at','desc')->paginate(10);
        return view('payments.removed_list',compact('data'));
    }

    public function add($id) {
        $data = PaymentProvider::findOrFail($id);

        $data->status = 0;
        $data->save();

        return redirect()->route('payments.index')->with('info','Payment Provider added successfully.');
    }

    public function create() {
        return view('payments.create');
    }

    public function store(StorePaymentProviderRequest $request) {
        $fileName = date('YmdHi').$request->file('payment_logo')->getClientOriginalName();
        $path = $request->file('payment_logo')->storeAs('payment-photos',$fileName,'public');

        $payment_provider = new PaymentProvider();
        
        $payment_provider->payment_logo = $path;
        $payment_provider->bank = $request->bank;
        $payment_provider->account = $request->account;
        $payment_provider->name = $request->name;
        $payment_provider->status = 0;
        $payment_provider->save();
        
        return redirect()->route('payments.index')->with('info','Payment Provider added successfully.');
    }

    public function edit($id) {
        $data = PaymentProvider::findOrFail($id);

        return view('payments.edit',compact('data'));
    }

    public function update(UpdatePaymentProviderRequest $request,$id) {
        $payment_provider = PaymentProvider::find($id);
        
        if($request->payment_logo) {
            if(file_exists(public_path('storage/'.$payment_provider->payment_logo))) {
                unlink(public_path('storage/'.$payment_provider->payment_logo));  // delete old photo
            }

            $fileName = date('YmdHi').$request->file('payment_logo')->getClientOriginalName();
            $path = $request->file('payment_logo')->storeAs('product-images',$fileName,'public'); 

            $payment_provider->payment_logo = $path;
        }
        $payment_provider->bank = $request->bank;
        $payment_provider->account = $request->account;
        $payment_provider->name = $request->name;
        $payment_provider->save();

        return redirect()->route('payments.index')->with('info','Payment Provider edited successfully.');
    }

    public function delete($id) { // just changing status,not actual deleting
        $payment_provider = PaymentProvider::findOrFail($id);

        $payment_provider->status = 1;
        $payment_provider->save();

        return redirect()->route('payments.index')->with('info','Payment Provider removed.');
    }
}
