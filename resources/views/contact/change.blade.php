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
            Change
        @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Change Information</h4>
                </div><!-- end card header -->

                <!-- show message -->
                @include('components.info')

                <div class="card-body">
                    <form action="{{ route('contact.update') }}" method="POST" enctype="multipart/form-data" id="form">
                        {{ method_field("PUT")}}
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Facebook Page Id</label>
                            <input type="text" class="form-control" value="{{ $data->facebook_link }}" name="facebook_link">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Viber</label>
                            <input type="text" class="form-control" value="{{ $data->viber }}" name="viber">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telegram</label>
                            <input type="text" class="form-control" value="{{ $data->telegram }}" name="telegram">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Agent</label>
                            <input type="text" class="form-control" value="{{ $data->agent_number }}" name="agent_number">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea5" class="form-label">Additional Phone Numbers</label>
                            <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" name="additional_phone_numbers">{{ $data->additional_phone_numbers }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea5" class="form-label">Additional Viber Phone Numbers</label>
                            <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" name="additional_viber_phone_numbers">{{ $data->additional_viber_phone_numbers }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Images</label>
                            <div class="input-images"></div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            let images = "{{ $data->image }}";
            let path = "{{ asset('storage/contact-photos') }}";
            let imgArr = [];

            if(images) {
                for (const img of images.split(',')) {
                    imgArr.push(
                        {
                            id: img,
                            src: path+"/"+img,
                        }
                    );
                }
            }

            $('.input-images').imageUploader({
                preloaded: imgArr,
                imagesInputName: 'images',
                preloadedInputName: 'old_photos',
                extensions: ['.jpg','.jpeg','.png','.gif','.svg'],
                mimes: ['image/jpeg','image/png','image/gif','image/svg+xml'],

                maxFiles: 3,
            });
        });

        $('#form').on("submit" ,function(){
            $('#des').val($('.ql-editor').html());
        });
    </script>
@endsection