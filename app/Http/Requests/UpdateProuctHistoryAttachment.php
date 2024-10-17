<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProuctHistoryAttachment extends FormRequest
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
         'title' => 'string|max:190',
         'youtube' => 'nullable|max:190',
         'is_active' => 'string|max:190',
         'history_images' => 'nullable|array',
         'history_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ];
    }
}
