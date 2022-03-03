@extends('core::admin.master')

@section('title', __('New pagebanner'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'pagebanners'])
        <h1 class="header-title">@lang('New pagebanner')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-pagebanners'))->multipart()->role('form') !!}
        @include('pagebanners::admin._form')
    {!! BootForm::close() !!}

@endsection
