<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\PaymentProvider;
use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    public function payment_provider_list() {
        $data = PaymentProvider::latest()->get();

        return response()->all_payment_providers($data);
    }

    public function payment_provider($id) {
        $data = PaymentProvider::findOrFail($id);

        return response()->payment_provider($data);
    }
}
