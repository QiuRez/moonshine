<?php

namespace App\Http\Response;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class SuccessEmptyResponse implements Responsable
{

  public function __construct(
    private readonly string $message,
    private readonly int $code = Response::HTTP_OK
  ) {}

  public static function make(string $message, int $code = Response::HTTP_OK) 
  {
    return new static($message, $code);
  }

  public function toResponse($request): JsonResponse
  {
    $data = [
      'status' => 'success',
      'message' => $this->message,
    ];

    return response()->json(
      data: $data,
      status: $this->code,

    );
  }
}