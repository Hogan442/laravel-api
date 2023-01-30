<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
        // Validating the input from the user

        return [
            'vehicle_make' => ['required', 'string'],
            'vehicle_model' => ['required', 'string'],
            'model_year' => ['required', 'integer', 'min:2010', 'max:2023'],
            'passenger_capacity' => ['required', 'integer', 'min:1', 'max:16'],
            'insured' => ['required', 'boolean'],
            'last_service' => ['date_format:Y-m-d', 'before:today'],
            'license_plate' => ['required', 'string', 'min:7'],
            'driver_id' => ['required', 'integer']
        ];
    }
}
