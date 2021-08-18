@extends('backend.layouts.base')

@section('title', trans('pages.about'))

@php($object = $order)
@php($route = 'order')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Информация о заказе</h4>
                            <table class="table table-striped table-bordered datatable mb-0">
                                <tbody>
                                    @include('backend.pages.partials.tr-text', ['data' => "№$object->code", 'locale' => 'fields.code', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => "$object->city", 'locale' => 'fields.city', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->date, 'locale' => 'fields.date', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->time, 'locale' => 'fields.time', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->delivery, 'locale' => 'fields.delivery', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->status, 'locale' => 'fields.status', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->comment, 'locale' => 'fields.order.comment', 'tr' => 'textarea'])
                                </tbody>
                            </table>
                            <h4 class="mt-4">Получатель</h4>
                            <table class="table table-striped table-bordered datatable mb-0">
                                <tbody>
                                    @include('backend.pages.partials.tr-text', ['data' => $object->reciever->name, 'locale' => 'fields.fullname', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->reciever->phone_number, 'locale' => 'fields.phone_number', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $object->reciever->email, 'locale' => 'fields.email_address', 'tr' => 'text'])
                                </tbody>
                            </table>

                            <h4 class="mt-4">Товары ({{ $order->count }})</h4>
                            @foreach ($order->products as $product)
                            <table @class(['mt-2' => !$loop->first, 'table table-striped table-bordered datatable mb-0'])>
                                <tbody>
                                    @include('backend.pages.partials.tr-text', ['data' => $product->id, 'locale' => 'fields.id', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-image', ['image' => $product->image])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->name, 'locale' => 'fields.name', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->category->name, 'locale' => 'fields.category', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => "$product->price тг", 'locale' => 'fields.price', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->discount, 'locale' => 'fields.discount', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->count, 'locale' => 'fields.count', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->size, 'locale' => 'fields.size', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->format, 'locale' => 'fields.format', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-text', ['data' => $product->type->name, 'locale' => 'fields.type', 'tr' => 'text'])
                                    @include('backend.pages.partials.tr-route', ['name' => __('fields.product.link'), 
                                        'route' => route('backend.products.show', $product->id),
                                        'colspan' => 2
                                    ])
                                </tbody>
                            </table>
                            @if (!$loop->last)
                                <hr>
                            @endif
                            @endforeach
                            <table class="table table-striped table-bordered datatable mb-0 mt-4">
                                <tbody>
                                    @include('backend.pages.partials.tr-text', ['data' => "$object->total_price тг", 'locale' => 'fields.total_price', 'tr' => 'text'])
                                </tbody>
                            </table>
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