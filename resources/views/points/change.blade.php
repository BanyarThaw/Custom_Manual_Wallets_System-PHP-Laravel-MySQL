@extends('layouts.master')

@section('title')
    @lang('translation.gallery')
@endsection

@section('point')
    active
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Point
        @endslot
        @slot('title')
            Change
        @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Change Point Value</h4>
                </div><!-- end card header -->

                <!-- show message -->
                @include('components.info')

                <div class="card-body">
                    <!-- create form  -->
                    <form action="{{ route('points.change') }}" method="post">
                        @csrf
                        <label for="name" class="form-label">New Value</label>
                        <input type="number" class="form-control" name="value">
                        <br>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">Change</button>
                        </div>
                    </form>
                </div><!-- end card -->
            </div>
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection
