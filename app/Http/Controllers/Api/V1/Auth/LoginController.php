<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\SuccessJsonResponse;
use App\Services\Auth\LoginService;

class LoginController extends Controller
{
    /**
     * @var LoginService
     */
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request): SuccessJsonResponse
    {
        $data = $request->validated();
        $response = $this->loginService->login($data);

        return new SuccessJsonResponse($response);
    }
}
