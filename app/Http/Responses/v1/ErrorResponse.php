<?php

namespace App\Http\Responses\v1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ErrorResponse implements Responsable
{

    function __construct(
        private string $title,
        private string|array $detail,
        private string $instance,
        private string $code,
        private string $link,
        private int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ) {}
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return new JsonResponse([
            'title' => $this->title,
            'detail' => $this->detail,
            'instance' => $this->instance,
            'code' => $this->code,
            'link' => $this->link,
            'status' => $this->statusCode,
        ], $this->statusCode);
    }
}
