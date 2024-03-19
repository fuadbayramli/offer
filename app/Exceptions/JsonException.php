<?php

namespace App\Exceptions;

use App\Http\Traits\Responsible;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class JsonException
 *
 * @package App\Exceptions
 * @author Mahammad Mammadov
 */
class JsonException extends Exception
{
    use Responsible;

    /**
     * Render the exception into an HTTP response.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->errorResponse($this->message, [], $this->code);
    }
}
