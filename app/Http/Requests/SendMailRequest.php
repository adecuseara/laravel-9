<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $token = explode('|', request()->api_token);
        $availableToken = request()->user->tokens()->where('id', $token[0])->first();

        if (! $availableToken) {
            return false;
        }

        return hash('sha256', $token[1]) === $availableToken->token;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'emails' => 'required|array',
            '*.*.mail' => 'required|string|email',
            '*.*.subject' => 'required|string',
            '*.*.body' => 'required|string',
        ];
    }
}
