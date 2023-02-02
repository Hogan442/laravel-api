<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
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

        if($method == 'PUT') {

            return [
                'id_number' => ['required', 'integer'],
                'phone_number' => ['required', 'integer']
            ];
        }

        return [
            'id_number' => ['sometimes', 'required', 'integer'],
            'phone_number' => ['sometimes', 'required', 'integer']
        ];
    }
}
