<?php

namespace App\Http\Requests;

use App\Performer;
use Illuminate\Foundation\Http\FormRequest;

class PerformersRequest extends FormRequest
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
        $rules = [
            'letter' => 'required',
            'name' => 'required',
            'country' => 'required',
            'images.*' => 'image|mimes:jpeg,bmp,png|max:2000',
            'price' => 'required|numeric'
        ];

        foreach (config('languages') as $key => $val) {
            foreach (Performer::$translatable_attributes as $attribute) {
                $rules['translations.' . $attribute . '.' . $key] = 'required';
            }
        }

        return $rules;
    }
}
