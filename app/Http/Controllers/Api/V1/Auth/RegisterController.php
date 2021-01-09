<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\SuccessJsonResponse;
use App\Services\Auth\RegisterService;

class RegisterController extends Controller
{
    /**
     * @var RegisterService
     */
    protected $registerService;

    public function __construct(RegisterService $registerService) {
        $this->registerService = $registerService;
    }

    public function handle(RegisterRequest $registerRequest): SuccessJsonResponse
    {
        $registerRequest->validated();
        $response = $this->registerService->register($registerRequest->all());

        return new SuccessJsonResponse($response);
    }
}
