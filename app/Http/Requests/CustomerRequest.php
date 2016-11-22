<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $customerId = $this->route('customer');

        return [
            'phone' => 'required|digits_between:9,11|unique:customers,phone,'.$customerId,
            'tax_num' => 'required|numeric|unique:customers,tax_num,'.$customerId,
        ];
    }

    public function messages()
    {
        return [
            'tax_num.unique' => 'The tax code has been taken.',
        ];
    }
}
