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
            List
        @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Removed Payment List</h4>
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
                                                <th scope="col">Logo</th>
                                                <th scope="col">Bank</th>
                                                <th scope="col">Account</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $dt)
                                                <tr>
                                                    <td class="fw-medium">
                                                        <img src="{{ asset('storage/'.$dt->payment_logo) }}" class="rounded-circle" alt="" width="35" height="35">
                                                    </td>
                                                    <td>{{ $dt->bank }}</td>
                                                    <td>{{ $dt->account }}</td>
                                                    <td>{{ $dt->name }}</td>
                                                    <td>
                                                        <a href="{!! route('payments.add',$dt->id) !!}" class="delete_button">    
                                                            <i class="bx bx-plus fs-20"></i>
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
                    {{ $data->links('components.pagination') }}
                </div>
                <br>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div><!--end row-->

@endsection

