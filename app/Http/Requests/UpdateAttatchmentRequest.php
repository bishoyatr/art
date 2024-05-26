<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttatchmentRequest extends FormRequest
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
             'id' => 'required',
             'description' => 'nullable',
             'photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
             'pdf_file' => 'nullable|mimes:pdf|max:10000',
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
            'photo.max' => 'The photo may not be greater than 5000 kilobytes.',
            'pdf_file.required' => 'The PDF file is required.',
            'pdf_file.mimes' => 'Please upload a valid PDF file.',
            'pdf_file.max' => 'The PDF file must not exceed 10,000 kilobytes.',
            'youtube.required' => 'The youtube field is required.',
            'instagram.required' => 'The instagram field is required.',
            'facebook.required' => 'The facebook field is required.',
            'shop.required' => 'The shop field is required.',
            'is_active.required' => 'The is_active field is required.',
        ];
    }
}
