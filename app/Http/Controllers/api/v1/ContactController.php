<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function contact_information() {
        $contact = Contact::findOrFail(1);
        return response()->contactInformation($contact);
    }
}
