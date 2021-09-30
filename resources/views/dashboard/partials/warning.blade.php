@if (session()->has('warning'))

    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="icon fa fa-warning"></i><em>{{ session()->get('warning') }}</em>
    </div>

@endif
