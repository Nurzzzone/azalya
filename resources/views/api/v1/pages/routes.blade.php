@extends('api.v1.layouts.base')

@section('title', 'Overview')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered datatable mb-0">
                                <tbody>
                                    @include('api.v1.pages.shared.login')
                                    @include('api.v1.pages.shared.register')
                                    @include('api.v1.pages.shared.home')
                                    @include('api.v1.pages.shared.products')
                                    @include('api.v1.pages.shared.product')
                                    @include('api.v1.pages.shared.about')
                                    @include('api.v1.pages.shared.delivery')
                                    @include('api.v1.pages.shared.contacts')
                                    @include('api.v1.pages.shared.favorite')
                                    @include('api.v1.pages.shared.user-favorite')
                                    @include('api.v1.pages.shared.category')
                                    @include('api.v1.pages.shared.checkout')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
