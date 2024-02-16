@extends('layouts.master')

@section('title')
    @lang('translation.gallery')
@endsection

@section('deposit')
    active
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Deposit Requests
        @endslot
        @slot('title')
            List
        @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Pending Deposit Requests List</h4>
                    <a href="{!! route('deposits.excel.form',0) !!}">
                        <button type="submit" class="btn btn-dark">Excel Download</button>
                    </a>
                </div><!-- end card header -->

                <!-- show message -->
                @include('components.info')

                <!-- show modal -->
                @include('components.modal')

                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-dark table-striped table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">User Id</th>
                                                <th scope="col">Bank Account Number Or Phone Number</th>
                                                <th scope="col">Payment</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Photo</th>
                                                <th scope="col">Total Points</th>
                                                <th scope="col">Point Value</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($deposits as $deposit)
                                                <tr>
                                                    <td>{{ $deposit->created_at->format('d-m-Y') }}</td>
                                                    <td>{{ $deposit->user_id }}</td>
                                                    <td>{{ $deposit->user_account }}</td>
                                                    <td>{{ $deposit->payment->bank }}</td>
                                                    <td>{{ $deposit->amount }} ks</td>
                                                    <td class="fw-medium">
                                                        <a href="{!! route('deposits.photo',$deposit->id) !!}" class="payment_receipts">
                                                            <img src="{{ asset('storage/'.$deposit->photo) }}" class="rounded-circle" alt="" width="35" height="35">
                                                        </a>
                                                    </td>
                                                    <td>{{ $deposit->total_points }}</td>
                                                    <td>{{ $deposit->point_value }} ks </td>
                                                    <td>
                                                        <a href="{!! route('deposits.approve',$deposit->id) !!}" class="delete_button">    
                                                            <i class=" bx bx-log-in-circle fs-20" id="accepted-logo"></i>
                                                        </a>
                                                        &nbsp;&nbsp;
                                                        <a href="{!! route('deposits.reject',$deposit->id) !!}" class="delete_button"
                                                            onClick="return confirm('Are you sure?')"
                                                        >    
                                                            <i class="bx bx-no-entry fs-20" id="rejected-logo"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                </div><!-- end card-body -->
                <div
                    class="align-items-center mt-4 pt-2 justify-content-between d-flex">
                    <div class="flex-shrink-0"></div>
                    {{ $deposits->links('components.pagination') }}
                </div>
                <br>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div><!--end row-->

@endsection

