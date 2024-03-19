<?php

namespace App\Exceptions;

use App\Http\Traits\Responsible;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class AlreadyLikedJsonException
 *
 * @package App\Exceptions
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class AlreadyLikedJsonException extends Exception
{
  use Responsible;

    /**
     * Render the exception into an HTTP response.
     *
     * @return JsonResponse
     */
  public function render()
  {
      return $this->errorResponse($this->message, [], $this->code);
  }
}
