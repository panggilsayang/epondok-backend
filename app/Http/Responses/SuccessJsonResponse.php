<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class SuccessJsonResponse implements Responsable
{
    protected array $data = [];
    protected string $message = '';

    public function __construct(array $data, string $message = 'Success')
    {
        $this->data = $data;
        $this->message = $message;
    }

    public function toResponse($request)
    {
        return new JsonResponse(['data' => $this->data, 'message' => $this->message, 'status' => true, 'code' => 1]);
    }
}
