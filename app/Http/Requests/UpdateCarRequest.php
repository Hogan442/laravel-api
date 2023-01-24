<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
                'vehicle_make' => ['required'],
                'vehicle_model' => ['required'],
                'model_year' => ['required'],
                'passenger_capacity' => ['required']
            ];
        }

        return [
            'vehicle_make' => ['sometimes','required'],
            'vehicle_model' => ['sometimes','required'],
            'model_year' => ['sometimes','required'],
            'passenger_capacity' => ['sometimes','required']
        ];
    }
}
