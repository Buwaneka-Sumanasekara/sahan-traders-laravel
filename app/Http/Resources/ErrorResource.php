<?php

namespace App\Http\Resources;

use App\Exceptions\AuthenticationException;
use App\Exceptions\UserNotFoundException;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    public static $wrap = 'error';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource instanceof ValidationException) {
            return [
                'code' => 'error-001',
                'message' => $this->getMessage(),
            ];
        } else {
            return [
                'code' => $this->getCode(),
                'message' => $this->getMessage(),
            ];
        }
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request
     * @param  \Illuminate\Http\Response
     * @return void
     */
    public function withResponse($request, $response)
    {
        // dd($this->resource);
        if ($this->resource instanceof AuthenticationException) {
            $response->setStatusCode(401);
        } else if ($this->resource instanceof UserNotFoundException) {
            $response->setStatusCode(401);
        } else if ($this->resource instanceof ValidationException) {
            $response->setStatusCode(502);
        } else {
            $response->setStatusCode(500);
        }
    }
}
