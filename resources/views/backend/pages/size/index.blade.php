@extends('backend.layouts.base')

@section('title', trans('pages.size'))

@php($route = 'size')
@php($objects = $sizes)

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('backend.pages.partials.flash-message')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            @include('backend.pages.products.__dropdown')
                            <a class="btn btn-success" href="{{ route("backend.$route.create") }}">@lang('buttons.create')</a>
                        </div>
                        <div class="card-body">
                            @include("backend.pages.$route.__table")
                            @include('backend.pages.partials.modal', ['url' => "/admin/$route/"])
                        </div>
                        <div class="card-footer">{{ $objects->links('backend.shared.pagination', ['paginator' => $objects]) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/table-row.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection