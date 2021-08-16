@extends('backend.layouts.base')

@section('title', trans('pages.pages'))

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered datatable mb-0" id="accordion">
                                <tbody>
                                    @include('backend.pages.partials.tr-route', 
                                        ['name' => __('pages.homepage'), 'childs' =>  [
                                            ['name' => 'pages.homepage.slider', 'route' => route('backend.homepage.slider.index')],
                                            ['name' => 'pages.homepage.cards', 'route' => route('backend.homepage.card.index')],
                                            ['name' => 'pages.about', 'route' => route('backend.homepage.about.show')]
                                        ]
                                    ])
                                    @include('backend.pages.partials.tr-route', 
                                        ['name' => __('pages.products.page'), 'childs' => [
                                            ['name' => 'pages.products', 'route' => route('backend.products.index')],
                                            ['name' => 'pages.about', 'route' => route('backend.product.about.show')],
                                        ]
                                    ])
                                    @include('backend.pages.partials.tr-route', 
                                        ['name' => __('pages.about'), 'childs' => [
                                            ['name' => 'pages.about', 'route' => route('backend.about.show')],
                                            ['name' => 'pages.member', 'route' => route('backend.member.index')]
                                        ]
                                    ])
                                    @include('backend.pages.partials.tr-route', 
                                        ['name' => __('pages.delivery'), 'route' => route('backend.delivery.show')])
                                    @include('backend.pages.partials.tr-route', ['name' => __('pages.contacts'), 'childs' => [
                                        ['name' => 'pages.list', 'route' => route('backend.contacts.index')],
                                        ['name' => 'pages.map', 'route' => route('backend.map.show')]
                                    ]])
                                    @include('backend.pages.partials.tr-route', 
                                        ['name' => __('pages.common'), 'childs' => [
                                            ['name' => 'pages.benefit', 'route' => route('backend.benefit.index')]
                                        ]
                                    ])
                                </tbody>
                            </table>
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