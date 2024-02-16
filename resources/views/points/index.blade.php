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
            Information
        @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Information</h4>
                    <a href="{{ route('points.form') }}">
                        <button type="submit" class="btn btn-dark">Change</button>
                    </a>
                </div><!-- end card header -->

                <!-- show message -->
                @include('components.info')

                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <div class="col-xl-12">
                                <p>{{ $current_point_value->point }} Point = {{ $current_point_value->value }}ks [Current Point Value]</p>
                                <h5>History [Changed Logs]</h5>
                                <div class="table-responsive">
                                    <table class="table table-dark table-striped table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Changed Date</th>
                                                <th scope="col">Point</th>
                                                <th scope="col">Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $dt)
                                                <tr>
                                                    <td>{{ $dt->created_at->format('d-m-Y [H:i]') }}</td>
                                                    <td>{{ $dt->point }}</td>
                                                    <td>{{ $dt->value }} ks</td>
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

