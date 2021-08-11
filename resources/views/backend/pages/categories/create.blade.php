@extends('backend.layouts.base')

@section('title', trans('pages.prices.create'))

@php($object = $category)
@php($route = 'categories')
@php($options = [
    'method'  => 'POST',
    'url'     => route("backend.$route.store")
])

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            @include('backend.pages.partials.flash-message')
            <div class="row">
                @include('backend.pages.partials.validation')
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('pages.prices.create')</h4>
                        </div>
                        <div class="card-body">
                            {{ Form::model($object, $options) }}
                            @include("backend.pages.$route.__form")
                            <div class="d-flex justify-content-end align-items-center">
                                <a class="btn btn-success mr-1" href="{{ route("backend.$route.index") }}">@lang('buttons.back')</a>
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