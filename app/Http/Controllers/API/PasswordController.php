<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\UpdateUserPassword;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function update(Request $request, UpdateUserPassword $updater): JsonResponse
    {
        $updater->fillPassword($request->user(), $request->password);

        return response()->json('', 200);
    }
}
