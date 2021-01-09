<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<string>
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]|mixed[]
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $notFoundHttpException)
        {
            return new JsonResponse([
                'status' => false,
                'code' => 0,
                'message' => 'Data not found',
                'trace' => $notFoundHttpException->getMessage(),
                'prev' => $notFoundHttpException->getTraceAsString(),
            ], Response::HTTP_NOT_FOUND);
        });
        $this->renderable(function (BaseServiceException $baseServiceException) {
            return new JsonResponse([
                'status' => false,
                'code' => 0,
                'message' => $baseServiceException->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    }
}
