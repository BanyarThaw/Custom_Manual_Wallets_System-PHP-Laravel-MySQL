@extends('layouts.master')

@section('title')
    @lang('translation.gallery')
@endsection

@section('payment')
    active
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Payments
        @endslot
        @slot('title')
            Create
        @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Create New Payment</h4>
                </div><!-- end card header -->

                <!-- show message -->
                @include('components.info')

                <div class="card-body">
                    <!-- create form  -->
                    <form action="{{ route('payments.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="bank" class="form-label">Payment Logo</label>
                        <input type="file" class="form-control" name="payment_logo">
                        <br>

                        <label for="bank" class="form-label">Bank</label>
                        <input type="text" class="form-control" name="bank">
                        <br>

                        <label for="account" class="form-label">Account</label>
                        <input type="text" class="form-control" name="account">
                        <br>

                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name">
                        <br>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">Create</button>
                        </div>
                    </form>
                </div><!-- end card -->
            </div>
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection
