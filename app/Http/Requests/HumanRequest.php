<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HumanRequest extends FormRequest
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
        $humanId = $this->route('human');

        return [
            'name' => 'required',
            'start_day' => 'required',
            'birth' => 'required',
            'gender' => 'required',
            'address1' => 'required',
            'phone' => 'required|digits_between:9,11|unique:humans,phone,'.$humanId,
            'idnum' => 'required|digits_between:9,12|unique:humans,idnum,'.$humanId,
            'job' => 'required',
            'photo' => 'mimes:jpeg,png,bmp',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
