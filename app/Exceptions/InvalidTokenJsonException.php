<?php

namespace App\Exceptions;

use App\Http\Traits\Responsible;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class InvalidTokenJsonException
 *
 * @package App\Exceptions
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class InvalidTokenJsonException extends Exception
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
