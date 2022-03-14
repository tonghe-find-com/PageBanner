<?php

namespace TypiCMS\Modules\Pagebanners\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'image_id' => 'nullable|integer',
            'mobile_image_id' => 'nullable|integer',
            'target' => 'nullable|max:255',
            'status.*' => 'boolean',
        ];
    }
}
