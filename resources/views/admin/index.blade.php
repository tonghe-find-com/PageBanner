@extends('core::admin.master')

@section('title', __('Pagebanners'))

@section('content')

<item-list
    url-base="/api/pagebanners"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,image_id,mobile_image_id,status,target,updated_at"
    table="pagebanners"
    title="pagebanners"
    include="image"
    appends="thumb,name,mobile_thumb"
    :exportable="false"
    :sorting="['target']">

    <template slot="add-button" v-if="$can('create pagebanners')">
        @include('core::admin._button-create', ['module' => 'pagebanners'])
    </template>

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox" v-if="$can('update pagebanners')||$can('delete pagebanners')"></item-list-column-header>
        <item-list-column-header name="edit" v-if="$can('update pagebanners')"></item-list-column-header>
        <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
        <item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>
        <item-list-column-header name="target" sortable :sort-array="sortArray" :label="$t('目標頁面')"></item-list-column-header>
        <item-list-column-header :label="$t('Last Update Time')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox" v-if="$can('update pagebanners')||$can('delete pagebanners')"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
        <td v-if="$can('update pagebanners')">@include('core::admin._button-edit', ['module' => 'pagebanners'])</td>
        <td><item-list-status-button :model="model"></item-list-status-button></td>
        <td><img :src="model.thumb" alt="" height="27"></td>
        <td>@{{ model.name }}</td>
        <td>@{{ getMoment(model.updated_at ) }}</td>
    </template>

</item-list>

@endsection
