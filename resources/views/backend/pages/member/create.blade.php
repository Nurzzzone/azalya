@extends('backend.layouts.base')

@section('title', trans('pages.prices.create'))

@section('css')
    <link rel="stylesheet" href="{{ asset('css/quill.css') }}">
@endsection

@php($object = $member)
@php($route = 'member')
@php($options = [
    'method'  => 'POST',
    'url'     => route("backend.$route.store"),
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

@section('vendor-scripts')
    <script src="{{ asset('js/vendors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('js/vendors/quill/highlight.min.js') }}"></script>
@endsection

@section('scripts')
    <script src="{{ asset('js/quill.js') }}"></script>
    <script src="{{ asset('js/upload-image.js') }}"></script>
    <script src="{{ asset('js/translation.js') }}"></script>
@endsection