@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible text-center" role="alert" bis_skin_checked="1">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        {{ $message }}
    </div>
@endif