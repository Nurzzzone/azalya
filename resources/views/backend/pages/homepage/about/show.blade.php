@extends('backend.layouts.base')

@section('title', trans('pages.pages'))

@php($object = $about)
@php($route = 'homepage.about')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered datatable mb-0">
                                <tbody>
                                    @include('backend.pages.partials.tr-image', ['image' => $object->image])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->name, 'locale' => 'fields.name', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->description, 'locale' => 'fields.description', 'tr' => 'textarea'])
                                    @include('backend.pages.partials.tr-active', ['data' => $object->is_active])
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