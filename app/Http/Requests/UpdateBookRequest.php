<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public $validatorError;
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
            'book' => 'required|json',
            'image_name' => 'max:1024',
            'file_name' => 'max:1024'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->validatorError = $validator;
    }

}
