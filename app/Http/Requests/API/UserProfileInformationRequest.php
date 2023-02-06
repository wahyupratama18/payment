<?php

namespace App\Http\Requests\API;

use App\Http\Requests\JsonFormRequest;
use App\Http\Requests\UserProfileInformationTrait;

class UserProfileInformationRequest extends JsonFormRequest
{
    use UserProfileInformationTrait;

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
