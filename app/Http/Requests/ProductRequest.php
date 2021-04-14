<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product'   => 'required|string',
            'desc'      => 'nullable|string|max:300',
            'type'      => 'required|string|max:36',
            'price'     => 'required|integer|digits_between:1,7',
            // 'photo'     => 'nullable|string'
        ];
    }
}
