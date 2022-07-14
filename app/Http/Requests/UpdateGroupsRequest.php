<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGroupsRequest extends FormRequest
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
                Rule::unique('groups', 'code')->ignore($this->group)->whereNull('removedAt'),
            ],
            'name' => 'required|string|max:63',
  
            'analytics.propertyId' => 'nullable|alpha_num',
  
            'meta.title' => 'nullable',
            'meta.description' => 'nullable|string',
            'meta.privacy' => 'nullable|string',
            'meta.guideline' => 'nullable|string',
        ];
    }
}
