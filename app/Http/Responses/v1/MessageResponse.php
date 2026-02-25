<?php

namespace App\Http\Responses\v1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MessageResponse implements Responsable
{

    function __construct(
        private string $message,
        private ?object $data = null,
        private int $statusCode = Response::HTTP_OK
    ) {}
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return new JsonResponse(
            data: [
                'message' => $this->message,
                'data' => $this->data,
            ],
            status: $this->statusCode
        );
    }
}
