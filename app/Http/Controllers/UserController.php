<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Generate token for user
     *
     * @param User $user
     *
     * @return JsonResponse
     */
    public function token(User $user): JsonResponse
    {
        $token = $user->createToken(config('app.name'))->plainTextToken;
        return response()->json(['token' => $token], 200);
    }
}
