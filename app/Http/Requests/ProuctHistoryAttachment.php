<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProuctHistoryAttachment extends FormRequest
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
         'title' => 'required|string|max:190',
         'youtube' => 'nullable|string|max:190',
         'is_active' => 'required',
         'history_images' => 'required|array|min:1',
         'history_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000'
        ];
    }
}
