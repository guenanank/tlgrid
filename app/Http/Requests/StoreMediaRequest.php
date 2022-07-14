<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaRequest extends FormRequest
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
            'groupId' => 'required|exists:groups,_id',
            'name' => 'required|string|max:63',
            'domain' => [
                'required', 'url', 'max:127',
                Rule::unique('media', 'domain')->whereNull('removedAt')
            ],

            'analytics.gaId' => 'nullable|alpha_num',
            'analytics.youtubeId' => 'nullable|string',

            'meta.title' => 'nullable|string|max:255',
            'meta.keywords' => 'nullable|string',
            'meta.color' => 'nullable|string|max:7',
            'meta.description' => 'nullable|string',

            'assets.logo' => 'nullable|file',
            'assets.logoAlt' => 'nullable|file',
            'assets.icon' => 'nullable|file',
            'assets.css' => 'nullable|file',
            'assets.js' => 'nullable|file',

            'social.facebook' => 'nullable|array',
            'social.instagram' => 'nullable|string',
            'social.twitter' => 'nullable|string',
            'social.youtube' => 'nullable|string',

            'masthead.about' => 'nullable',
            'masthead.editorial' => 'nullable',
            'masthead.management' => 'nullable',
            'masthead.contact' => 'nullable'
        ];
    }
}
