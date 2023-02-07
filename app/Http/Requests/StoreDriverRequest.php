<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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

        // return request()->validate(
        //     [
        //     'id_number' => ['required', 'integer', 'min:1111111111', 'max:9999999999'],
        //     'phone_number' => ['required', 'integer', 'min:111111111', 'max:999999999'],
        //     'home_address' => ['required', 'string'],
        //     'first_name' => ['required', 'string'],
        //     'last_name' => ['required', 'string'],
        //     'license_type' => ['required'],
        //     ], 
        //     [
        //         'id_number.min' => 'Your ID number must consist of 13 integers',
        //         'id_number.max' => 'Your ID number must consist of 13 integers'
        //     ]
        // );

        return [
            'id_number' => ['required', 'integer', 'min:1111111111', 'max:9999999999'],
            'phone_number' => ['required', 'integer', 'min:111111111', 'max:999999999'],
            'home_address' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'license_type' => ['required'],
        ];
    }
}
