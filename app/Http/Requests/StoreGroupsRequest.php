<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGroupsRequest extends FormRequest
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
            'code' => [
                'present', 'alpha_num', 'max:4',
                Rule::unique('groups', 'code')->whereNull('removedAt')
            ],
            'name' => 'required|string|max:63',

            'analytics.propertyId' => 'nullable|alpha_dash',

            'meta.title' => 'nullable|string|max:127',
            'meta.description' => 'nullable|string',
            'meta.privacy' => 'nullable|string',
            'meta.guideline' => 'nullable|string',
        ];
    }
}
