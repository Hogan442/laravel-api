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
                'vehicle_make' => ['required', 'string'],
                'vehicle_model' => ['required', 'string'],
                'model_year' => ['required', 'integer', 'min:2010', 'max:2023'],
                'passenger_capacity' => ['required', 'integer', 'min:1', 'max:16']
            ];
        }

        return [
            'vehicle_make' => ['sometimes','required', 'string'],
            'vehicle_model' => ['sometimes','required', 'string'],
            'model_year' => ['sometimes','required', 'integer', 'min:2010', 'max:2023'],
            'passenger_capacity' => ['sometimes','required', 'integer', 'min:1', 'max:16']
        ];
    }
}
