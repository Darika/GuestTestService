<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GuestsUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:guests,id',
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone' => ['required', 'string', Rule::unique('guests', 'phone')->ignore($this->id)],
            'email' => ['required', 'email', Rule::unique('guests', 'email')->ignore($this->id)],
            'country' => 'string|nullable'
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errorMessage' => $validator->errors()->getMessages(),
        ]));
    }
}
