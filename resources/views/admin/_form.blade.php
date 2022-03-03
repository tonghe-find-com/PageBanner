@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>

<file-field label="圖片" type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
<div style="color:#f6416c;position: relative; color: rgb(246, 65, 108); top: -17px;">建議圖片尺寸: 1920 x 300</div>
<div class="form-row">
    <div class="col-md-6">
        {!! BootForm::select(__('Target'), 'target', Pagebanners::getAllPage())->addClass('custom-select')->required() !!}
    </div>
</div>

<div class="form-group">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
