@extends('backend.layouts.base')

@section('title', trans('pages.map'))

@php($object = $map)
@php($route = 'map')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered datatable mb-0">
                                <tbody class="backend__map">
                                    @include('backend.pages.partials.tr-text', ['data' => $object->value, 'locale' => 'fields.map', 'tr' => 'textarea'])
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" href="{{ route("backend.$route.edit", $object->id) }}">@lang('buttons.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection