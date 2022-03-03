@extends('core::admin.master')

@section('title', $model->getNameAttribute())

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'pagebanners'])
        <h1 class="header-title @if (!$model->present()->title)text-muted @endif">
            {{ $model->getNameAttribute() ?? __('Untitled') }}
        </h1>
    </div>

    {!! BootForm::open()->put()->action(route('admin::update-pagebanner', $model->id))->multipart()->role('form') !!}
    {!! BootForm::bind($model) !!}
        @include('pagebanners::admin._form')
    {!! BootForm::close() !!}

@endsection
