@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible text-center" role="alert" bis_skin_checked="1">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        {{ $message }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>¡ Oh no :( !</strong> Ha ocurrido un error con la información.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif