<!-- show information messages -->
@if(Session::has('info'))
    <div class="text-center">
        <div class="alert alert-dark shadow fade show" role="alert">
            <strong>{{ Session::get('info') }}!!!</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<!-- show error messages -->
@if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="text-center">
            <div class="alert alert-primary alert-dismissible alert-solid alert-label-icon shadow fade show" role="alert">
                <i class="ri-check-double-line label-icon"></i><strong>{{$error}}</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endforeach
@endif