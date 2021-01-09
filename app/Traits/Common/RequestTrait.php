<?php

declare(strict_types=1);

namespace App\Traits\Common;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait RequestTrait
{
    /**
     * Used when validation is failed.
     * @param  Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(new JsonResponse($this->errorData($validator), Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function errorData(Validator $validator): array
    {
        $message = $validator->errors()->first();
        if (property_exists($this, 'message')) {
            $message = $this->message;
        }

        return [
            'status' => false,
            'code' => 0,
            'message' => $message,
            'data' => $validator->errors(),
        ];
    }
}
