<?php

namespace App\Http\Requests\World;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class WorldUpdateRequest extends FormRequest
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
            'asin'    => 'required|min:10',
            'country' => [
                'size:2',
                'nullable',
                Rule::in(config('amazon-feature.world_watch_item_locales')),
            ],
        ];
    }
}
