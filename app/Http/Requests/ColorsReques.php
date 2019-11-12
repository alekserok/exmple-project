<?php

namespace App\Http\Requests;

use App\Color;
use Illuminate\Foundation\Http\FormRequest;

class ColorsReques extends FormRequest
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
            'color' => 'required'
        ];

        foreach (config('languages') as $key => $val) {
            foreach (Color::$translatable_attributes as $attribute) {
                $rules['translations.' . $attribute . '.' . $key] = 'required';
            }
        }

        return $rules;
    }
}
