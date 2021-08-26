@extends('backend.layouts.base')

@section('title', trans('pages.delivery'))

@php($object = $delivery)
@php($route = 'delivery')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered datatable mb-0">
                                <tbody>
                                    @include('backend.pages.partials.tr-image', ['image' => "storage/$object->image"])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->title, 'locale' => 'fields.title', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->description_title, 'locale' => 'fields.description_title', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->description, 'locale' => 'fields.description', 'tr' => 'textarea'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->price_title, 'locale' => 'fields.payment_title', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->price, 'locale' => 'fields.payment', 'tr' => 'textarea'])

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