<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetailRequest extends FormRequest
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
//            'driver_id' => ['required'],
            'home_address'  => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'license_type' => ['required'],
//            'last_trip'
        ];
    }
}
