@extends('backend.layouts.base')

@section('title', trans('pages.prices.create'))

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('pages.prices.create')</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $options = [
                                  'method'  => 'POST',
                                  'url'     => route('backend.members.store'),
                                ];
                            @endphp
                            {{ Form::model($price, $options) }}
                            @include('backend.pages.members.__form')
                            <div class="d-flex justify-content-end align-items-center">
                                <a class="btn btn-success mr-1" href="{{ route('backend.members.index') }}">@lang('buttons.back')</a>
                                {{ Form::submit(trans('buttons.save'), ['class' => 'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection