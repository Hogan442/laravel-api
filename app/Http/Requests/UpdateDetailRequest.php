<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailRequest extends FormRequest
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

        $method = $this->method();

        if ($method == 'PUT') {

            return [
                'driver_id' => ['required'],
                'home_address' => ['required'],
                'first_name' => ['required'],
                'last_name' => ['required'],
                'license_type' => ['required'],
                'last_trip' => ['required']
            ];
        }

        return [
            'driver_id' => ['sometimes','required'],
            'home_address' => ['sometimes','required'],
            'first_name' => ['sometimes','required'],
            'last_name' => ['sometimes','required'],
            'license_type' => ['sometimes','required'],
            'last_trip' => ['sometimes','required']
        ];
    }
}
