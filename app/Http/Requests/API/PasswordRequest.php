<?php

namespace App\Http\Requests\API;

use App\Http\Requests\PasswordTrait;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    use PasswordTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
