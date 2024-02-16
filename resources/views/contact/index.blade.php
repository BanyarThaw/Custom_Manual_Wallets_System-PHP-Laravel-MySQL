@extends('layouts.master')

@section('title')
    @lang('translation.gallery')
@endsection

@section('contact_us')
    active
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Contact Us
        @endslot
        @slot('title')
            Information
        @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Contact Information</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <a href="{{ route('contact.change') }}" class="link-success">
                                <button type="button" class="btn btn-dark">Change</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <h5 class="card-title mb-0 flex-grow-1 contact_title">Facebook Page Id</h5>
                        <p>
                            <a href="{{ $data->facebook_link }}">
                                {{ $data->facebook_link }}
                            </a>
                        </p>
                        <h5 class="card-title mb-0 flex-grow-1 contact_title">Viber</h5>
                        <p>{{ $data->viber }}</p>
                        <h5 class="card-title mb-0 flex-grow-1 contact_title">Telegram</h5>
                        <p>{{ $data->telegram }}</p>
                        <h5 class="card-title mb-0 flex-grow-1 contact_title">Agent</h5>
                        <p>
                            {{ $data->agent_number }}
                        </p>
                        <h5 class="card-title mb-0 flex-grow-1 contact_title">Additional Phone Numbers</h5>
                        <p>
                            {{ $data->additional_phone_numbers }}
                        </p>
                        <h5 class="card-title mb-0 flex-grow-1 contact_title">Additional Viber Phone Numbers</h5>
                        <p>
                            {{ $data->additional_viber_phone_numbers }}
                        </p>
                        <h5 class="card-title mb-0 flex-grow-1 contact_title">Photos</h5>
                        <div class="row align-items-start">
                            @foreach($images as $key => $value)
                                <div class="col-sm-4">
                                    <figure class="figure">
                                        <img src="{{ asset('storage/contact-photos/'.$value) }}" class="figure-img img-fluid rounded photo_design" alt="...">
                                        <figcaption class="figure-caption"></figcaption>
                                    </figure>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

