@extends('backend.layouts.base')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        @include('backend.pages.partials.flash-message')
        <div class="row">
            @include('backend.pages.partials.validation')
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['method' => 'PATCH', 'url' => route("backend.password.update", Auth::user()->id)]) }}
                        @include('backend.pages.dashboard.__form')
                        <div class="d-flex justify-content-end align-items-center">
                            {{ Form::submit(trans('buttons.save'), ['class' => 'btn btn-success']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
