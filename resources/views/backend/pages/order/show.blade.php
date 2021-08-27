@extends('backend.layouts.base')

@section('title', trans('pages.about'))

@php($object = $order)
@php($route = 'order')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('backend.pages.partials.flash-message')
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            @include('backend.pages.order.__order')
                            @include('backend.pages.order.__reciever')
                            @include('backend.pages.order.__products')
                            @include('backend.pages.order.__price')
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" href="{{ route("backend.{$route}s.index") }}">@lang('buttons.back')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/table-row.js') }}"></script>
@endsection