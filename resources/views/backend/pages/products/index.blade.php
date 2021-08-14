@extends('backend.layouts.base')

@section('title', trans('pages.pages'))

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('backend.pages.partials.flash-message')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            @include('backend.pages.products.__dropdown')
                            <a class="btn btn-success" href="{{ route('backend.products.create') }}">@lang('buttons.create')</a>
                        </div>
                        <div class="card-body">
                            @include('backend.pages.products.__table')
                            @include('backend.pages.partials.modal', ['url' => '/admin/products/'])
                        </div>
                        <div class="card-footer">{{ $products->links('backend.shared.pagination', ['paginator' => $products]) }}</div>
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