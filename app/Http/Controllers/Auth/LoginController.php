<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;

use App\Http\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\Response;

final class LoginController
{
    public function __invoke(LoginRequest $request): Response
    {
        $request->authenticate();
        $token = auth()->user()?->createToken(name: 'api-auth');
        return new JsonResponse(data: [
            'token' => $token->plainTextToken,

        ]);
    }
}
