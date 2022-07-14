<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreChannelsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:channels,name|string|max:127',
            'sub' => 'exists:channels,id|nullable',
            'isDisplayed' => 'boolean',
            'sort' => 'numeric|nullable',

            'analytics.propertyId' => 'nullable|alpha_num',

            'meta.title' => 'nullable|string',
            'meta.description' => 'nullable|string',
            'meta.keywords' => 'nullable|string',
            'meta.cover' => 'nullable|file'
        ];
    }
}
