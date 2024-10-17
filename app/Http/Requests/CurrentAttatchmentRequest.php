<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrentAttatchmentRequest extends FormRequest
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
             'name' => 'required',
             'description' => 'required',
             'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
             'pdf_file' => 'required|mimes:pdf|max:200000',
             'youtube' => 'nullable',
             'instagram' => 'nullable',
             'facebook' => 'nullable',
             'shop' => 'nullable',
             'is_active' => 'required',
        ];
    }
     public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'description.required' => 'The description field is required.',
            'photo.required' => 'The photo field is required.',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg.',
            'photo.max' => 'The photo may not be greater than 20,000 kilobytes.',
            'pdf_file.required' => 'The PDF file is required.',
            'pdf_file.mimes' => 'Please upload a valid PDF file.',
            'pdf_file.max' => 'The PDF file must not exceed 200,000 kilobytes.',
            'youtube.required' => 'The youtube field is required.',
            'instagram.required' => 'The instagram field is required.',
            'facebook.required' => 'The facebook field is required.',
            'shop.required' => 'The shop field is required.',
            'is_active.required' => 'The is_active field is required.',
        ];
    }
}
