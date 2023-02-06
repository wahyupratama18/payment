<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\JsonFormRequest;
use App\Http\Requests\RegisterTrait;

class RegisterRequest extends JsonFormRequest
{
    use RegisterTrait;

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
