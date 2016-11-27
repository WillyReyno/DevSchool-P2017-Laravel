@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif


@if($success = Session::get('success'))
    <div class="alert alert-success">
        {{ $success }}
    </div>
@endif