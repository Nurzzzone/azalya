@extends('backend.layouts.base')

@section('title', trans('pages.pages'))

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <a class="btn btn-success" href="{{ route('backend.members.create') }}">@lang('buttons.create')</a>
                        </div>
                        <div class="card-body">
                            @include('backend.pages.members.__table')
                            @include('backend.pages.partials.modal', ['url' => '/admin/members/'])
                        </div>
                        <div class="card-footer">{{ $members->links('backend.shared.pagination', ['paginator' => $members]) }}</div>
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