@if(Session::has('message'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
        </div>
    </div>
@endif
@if(Session::has('error'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
        </div>
    </div>
@endif