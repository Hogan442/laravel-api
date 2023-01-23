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
                'id_number' => ['required'],
                'phone_number' => ['required']
            ];
        }

        return [
            'id_number' => ['sometimes', 'required'],
            'phone_number' => ['sometimes', 'required']
        ];
    }
}
