<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $path = 'storage/contact-photos/';

    public function index() {
        $data = Contact::findOrFail(1);
        $images = explode(',', $data->image);
        return view('contact.index',compact('data','images'));
    }

    public function change() {
        $data = Contact::findOrFail(1);
        return view('contact.change',compact('data'));
    }

    public function update(UpdateContactRequest $request) {
        // if image box was empty while updating
        if(empty($request->file('images')) && empty($request->old_photos)) {
            return redirect()->back()->with('info','Image field is required.');
        }       

        $contact = Contact::findOrFail(1);
        
        $contact->facebook_link = $request->facebook_link;
        $contact->viber = $request->viber;
        $contact->telegram = $request->telegram;
        $contact->agent_number = $request->agent_number;
        $contact->additional_phone_numbers = $request->additional_phone_numbers;
        $contact->additional_viber_phone_numbers = $request->additional_viber_phone_numbers;

        $image_record = explode(",",$contact->image);
        $old_photos =  $request->old_photos ?  $request->old_photos : [];
        $remove_photos = array_diff($image_record,$old_photos);
        $remove_photos = Arr::collapse([[],$remove_photos]);

        $old_images = $old_photos ? implode(',', $old_photos) : '';

        // deleting unselected photos
        if($remove_photos) {
            for($i=0;$i<count($remove_photos);$i++) {
                if($remove_photos[$i]) {
                    unlink(public_path($this->path.$remove_photos[$i]));
                }
            }
        }

        // add to storage if photos are exist in request
        if($request->hasFile('images')) {
            foreach($request->file('images') as $file)
            {
                $fileName = uniqid('fookbet').'.'.$file->extension();
                $imageNames[] = $fileName;
                $file->move(public_path($this->path), $fileName);
            }

            $new_images = implode(',', $imageNames);
            $new_images =  $old_images ?  $old_images.','.$new_images : $new_images;

            $contact->image = $new_images;
        } else {
            $contact->image = $old_images;
        }

        $contact->save();

        return redirect()->route('contact.index')->with('info','Contact Information Updated Successfully');
    }
}
