<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Laravel\Jetstream\Jetstream;

trait PasswordTrait
{
    use PasswordValidationRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
        ];
    }
}
