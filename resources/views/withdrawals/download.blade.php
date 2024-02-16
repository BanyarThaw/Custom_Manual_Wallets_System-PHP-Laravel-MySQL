@extends('layouts.master')

@section('title')
    @lang('translation.gallery')
@endsection

@section('withdrawal')
    active
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery-ui.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Excel File
        @endslot
        @slot('title')
            Download
        @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Download {{ $type }} Excel File ({{ $status }})</h4>
                </div><!-- end card header -->

                <!-- show message -->
                @include('components.info')

                <div class="card-body">
                    <!-- create form  -->
                    <form action="{{ route('withdrawals.excel.export') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" name="status" value="{{ $status }}">

                        <label for="bank" class="form-label">From Date</label>
                        <input type="text" class="form-control dateFilter" name="from_date">
                        <br>

                        <label for="name" class="form-label">To Date</label>
                        <input type="text" class="form-control dateFilter" name="to_date">
                        <br>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">Download</button>
                        </div>
                    </form>
                </div><!-- end card -->
            </div>
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection

@section('script')
    <script src="{{ URL::asset('/assets/js/jquery-ui.min.js') }}"></script>
    <script type='text/javascript'>
        $(document).ready(function(){
            $('.dateFilter').datepicker({
                dateFormat: "yy-mm-dd",
            });
        });
    </script>
@endsection
