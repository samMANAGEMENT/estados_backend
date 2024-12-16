<?php

namespace App\Http\Requests\Api\Guest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewGuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status_id' => [
                
                Rule::exists('statuses', 'id'),
            ],
            'user' => 'required|string',
            'ip' => 'required|string',
            'cc' => 'required|string',
            'expiration_date' => 'required|string',
            'ccv' => 'required|string',
            'user-agent' => 'sometimes|string',
        ];
    }
}
