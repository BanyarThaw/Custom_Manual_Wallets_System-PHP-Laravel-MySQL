@extends('layouts.master')

@section('title')
    @lang('translation.gallery')
@endsection

@section('withdrawal')
    active
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Reject Withdrawal Requests
        @endslot
        @slot('title')
            List
        @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Rejected Withdrawal Requests List</h4>
                    <a href="{!! route('withdrawals.excel.form',2) !!}">
                        <button type="submit" class="btn btn-dark">Excel Download</button>
                    </a>
                </div><!-- end card header -->

                <!-- show message -->
                @include('components.info')

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
                                                <th scope="col">Transaction No</th>
                                                <th scope="col">Total Points</th>
                                                <th scope="col">Point Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($withdrawals as $withdrawal)
                                                <tr>
                                                    <td>{{ $withdrawal->created_at->format('d-m-Y') }}</td>
                                                    <td>{{ $withdrawal->user_id }}</td>
                                                    <td>{{ $withdrawal->user_account }}</td>
                                                    <td>{{ $withdrawal->payment->bank }}</td>
                                                    <td>{{ $withdrawal->amount }} ks</td>
                                                    <td>{{ $withdrawal->transaction_no }}</td>
                                                    <td>{{ $withdrawal->total_points }}</td>
                                                    <td>{{ $withdrawal->point_value }} ks </td>
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
                    {{ $withdrawals->links('components.pagination') }}
                </div>
                <br>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div><!--end row-->

@endsection

