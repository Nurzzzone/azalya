@extends('backend.layouts.base')

@section('title', trans('pages.prices.edit'))

@section('css')
    <link rel="stylesheet" href="{{ asset('css/quill.css') }}">
@endsection

@php($object = $about)
@php($route = 'homepage.about')
@php($options = [
    'method'  => 'PATCH',
    'url'     => route("backend.{$route}.update", $object->id),
    'enctype' => 'multipart/form-data'
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
                            <h4>@lang('pages.size.edit')</h4>
                        </div>
                        <div class="card-body">
                            {{ Form::model($object, $options) }}
                            @include("backend.pages.{$route}.__form")
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

@section('vendor-scripts')
    <script src="{{ asset('js/vendors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('js/vendors/quill/highlight.min.js') }}"></script>
@endsection

@section('scripts')
    <script src="{{ asset('js/quill.js') }}"></script>
    <script src="{{ asset('js/upload-image.js') }}"></script>
@endsection