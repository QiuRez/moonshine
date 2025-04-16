<?php

namespace App\Http\Response;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ErrorResponse implements Responsable
{

  public function __construct(
    private readonly string $message,
    private readonly int $code = Response::HTTP_BAD_REQUEST
  ) {}

  public static function make(string $message, int $code = Response::HTTP_BAD_REQUEST) 
  {
    return new static($message,  $code);
  }

  public function toResponse($request): JsonResponse
  {
    $data = [
      'status' => 'error',
      'message' => $this->message
    ];

    return response()->json(
      data: $data,
      status: $this->code,
    );
  }
}