<?php

namespace App\Http\Requests;

use App\Promo;
use Illuminate\Foundation\Http\FormRequest;

class PromosRequest extends FormRequest
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
            'media' => 'max:10240' . ($this->method == 'POST' ? '|required' : ''),
            'location_page' => 'required',
            'link' => 'required',
            'type' => 'required',
        ];

        foreach (config('languages') as $key => $val) {
            foreach (Promo::$translatable_attributes as $attribute) {
                $rules['translations.' . $attribute . '.' . $key] = 'required';
            }
        }

        return $rules;
    }
}
