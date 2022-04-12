<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required|gte:0|lte:1000000',
            'type' => 'required|max:255'
        ];

        // In the frontend is not possible that these values are null but maybe some sneaky guy tries to modify the request with an external tool, so it is better to prevent that
        if (request()->has('establishment')) {
            $rules['establishment'] = 'required';
        } elseif (request()->has('brand')) {
            $rules['brand'] = 'required';
        }

        return $rules;
    }

    public function messages() {
        return [
            'required' => ':attribute is required',
            'max' => 'Max length for :attribute is 255',
            'price.gte' => 'Price cannot be negative',
            'price.lte' => 'Price too large'
        ];
    }
}
