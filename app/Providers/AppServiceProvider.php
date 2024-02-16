<?php

namespace App\Providers;

use Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // custom response for all payment providers
        Response::macro('all_payment_providers', function($data) {
            $providers_array = array();
            foreach($data as $dt) {
                $proivder = [
                    'payment_id' => $dt->id,
                    'payment_logo' => asset('storage/'.$dt->payment_logo),
                    'bank' => $dt->bank,
                    "account" => $dt->account,
                    "name" => $dt->name,
                ];
                array_push($providers_array,$proivder);
            }

            return response([
                'success' => true,
                'payments providers' => $providers_array,
            ],200);
        });

        // custom response for singel payement provider
        Response::macro('payment_provider',function($data) {
            $payment = array();
           
            $payment = [
                'payment_id' => $data->id,
                'payment_logo' => asset('storage/'.$data->payment_logo),
                'bank' => $data->bank,
                "account" => $data->account,
                "name" => $data->name,
            ];

            return response([
                'success' => true,
                'payment provider' => $payment,
            ],200);
        });

         // custom response for deposit history
         Response::macro('depositHistory', function($history) {
            $data = array();
            foreach($history as $ht) {
                $status = $ht->status;
                $status = ($status == 0) ? "pending" : (($status == 1)  ? "approved" : "rejected");
                //$status = ($ht->status == 0) ? "pending" : (($$ht->status == 1)  ? "approved" : "rejected");
                $data_history = [
                    'id' => $ht->id,
                    'bank account number or phone number' => $ht->user_account,
                    'payment' => $ht->payment->bank,
                    'amount' => $ht->amount.' MMK',
                    'total points' => $ht->total_points,
                    'point value' => $ht->point_value.' MMK',
                    'status' => $status,
                    'date' => $ht->created_at->format('d-m-Y'),
                    'time' => $ht->created_at->format('H:i A'),
                ];
                array_push($data, $data_history);
            }

            return response([
                'success' => true,
                'posts' => $data,
                'previous_page' => $history->previousPageUrl(),
                'current_page' => $history->url($history->currentPage()),
                'next_page' => $history->nextPageUrl(),
            ],200);
        });

        // custom response for withdrawal history
        Response::macro('withdrawalHistory', function($history) {
            $data = array();
            foreach($history as $ht) {
                $status = $ht->status;
                $status = ($status == 0) ? "pending" : (($status == 1)  ? "approved" : "rejected");
                //$status = ($ht->status == 0) ? "pending" : (($$ht->status == 1)  ? "approved" : "rejected");
                $data_history = [
                    'id' => $ht->id,
                    'bank account number or phone number' => $ht->user_account,
                    'payment' => $ht->payment->bank,
                    'amount' => $ht->amount.' MMK',
                    'total points' => $ht->total_points,
                    'point value' => $ht->point_value.' MMK',
                    'status' => $status,
                    'date' => $ht->created_at->format('d-m-Y'),
                    'time' => $ht->created_at->format('H:i A'),
                ];
                array_push($data, $data_history);
            }

            return response([
                'success' => true,
                'posts' => $data,
                'previous_page' => $history->previousPageUrl(),
                'current_page' => $history->url($history->currentPage()),
                'next_page' => $history->nextPageUrl(),
            ],200);
        });

        // custom response header for contact information
        Response::macro('contactInformation', function($contact) {
            $images_array = explode(',',$contact->image);

            $images = array();
            for($i=0;$i<count($images_array);$i++) {
                $key = 'image'.$i;
                $images[$key] = asset('storage/contact-photos/'.$images_array[$i]);
            }
        
            return response([
                'success' => true,
                'facebook page id' => $contact->facebook_link,
                'viber' => $contact->viber,
                'telegram' => $contact->telegram,
                'agent phone number' => $contact->agent_number,
                'additional phone numbers' => $contact->additional_phone_numbers,
                'additional viber phone numbers' => $contact->additional_viber_phone_numbers,
                'images' => $images,
            ],200);
        });
    }
}
