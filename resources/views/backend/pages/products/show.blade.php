@extends('backend.layouts.base')

@section('title', trans('pages.pages'))

@php
    $objects = 'products';
@endphp

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered datatable mb-0">
                                <tbody>
                                    @include('backend.pages.partials.tr-image', ['image' => $product->image])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->name, 'locale' => 'fields.name', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->price, 'locale' => 'fields.price', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->discount, 'locale' => 'fields.discount', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->category->name, 'locale' => 'fields.category', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-checked', ['data' => $product->formats, 'locale' => 'fields.format', 'plural' => 2,])
                                    @include('backend.pages.partials.tr-checked', ['data' => $product->sizes, 'locale' => 'fields.size', 'plural' => 2,])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->description, 'locale' => 'fields.description', 'tr' => 'textarea'])
                                    @include('backend.pages.partials.tr-active', ['data' => $product->is_active])
                                    @include('backend.pages.partials.tr-active', ['data' => $product->in_stock, 'locale' => 'in_stock'])
                                    @include('backend.pages.partials.tr-active', ['data' => $product->is_popular, 'locale' => 'is_popular'])
                                    @include('backend.pages.partials.tr-active', ['data' => $product->in_homepage, 'locale' => 'in_homepage'])
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" href="{{ url()->previous() }}">@lang('buttons.back')</a>
                            <a class="btn btn-success" href="{{ route("backend.{$objects}.edit", $product->id) }}">@lang('buttons.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection