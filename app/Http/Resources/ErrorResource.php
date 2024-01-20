<?php

namespace App\Http\Resources;

use App\Exceptions\AuthenticationException;
use App\Exceptions\EmailNotVerifiedException;
use App\Exceptions\ShipAndCoException;
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
        }else if ($this->resource instanceof ShipAndCoException) {
            return [
                'code' => $this->getCode(),
                'message' => $this->getMessage(),
                'data' => ($this->resource->getData()!==null) ? $this->resource->getData() : $this->resource,
            ];
        }else {
            return [
                'code' => 'error-001',
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
        }  else if ($this->resource instanceof ShipAndCoException) {
            $response->setStatusCode(502);
        } else if ($this->resource instanceof EmailNotVerifiedException) {
            $response->setStatusCode(403);
        } else {
            $response->setStatusCode(500);
        }
    }
}
