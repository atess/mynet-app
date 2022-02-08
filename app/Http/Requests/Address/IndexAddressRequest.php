<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class IndexAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'person_id' => 'required|exists:people,id',
        ];
    }
}
