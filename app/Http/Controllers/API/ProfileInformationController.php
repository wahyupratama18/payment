<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserProfileInformationRequest;
use Illuminate\Http\JsonResponse;

// use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class ProfileInformationController extends Controller
{
    public function update(UserProfileInformationRequest $request, UpdateUserProfileInformation $updater): JsonResponse
    {
        $updater->updateUser($request->user(), $request->validated());

        return response()->json($request->user(), 203);
    }
}
