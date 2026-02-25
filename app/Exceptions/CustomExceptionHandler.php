<?php

use App\Http\Responses\v1\ErrorResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;


class CustomExceptionHandler
{
    public static function create(Throwable $e, Request $request): ErrorResponse
    {
        if ($e instanceof NotFoundHttpException) {
            return new ErrorResponse(
                title: "Resource not found",
                detail: $e->getMessage(),
                instance: $request->path(),
                code: "RESOURCE_NOT_FOUND",
                link: "http://localhost:8000/api/v1/errors/404",
                statusCode: Response::HTTP_NOT_FOUND
            );
        } elseif ($e instanceof ValidationException) {
            return new ErrorResponse(
                title: "Validation failed",
                detail: json_encode($e->errors()),
                instance: $request->path(),
                code: "VALIDATION_FAILED",
                link: "http://localhost:8000/api/v1/errors/422",
                statusCode: Response::HTTP_NOT_FOUND
            );
        }
        return ErrorResponse(
            title: "Internal Server Error",
            detail: $e->getMessage(),
            instance: $request->path(),
            code: "INTERNAL_SERVER_ERROR",
            link: "http://localhost:8000/api/v1/errors/500",
            statusCode: Response::HTTP_NOT_FOUND
        );
    }
}
