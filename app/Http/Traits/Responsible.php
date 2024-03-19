<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

/**
 * Trait Responseable
 *
 * @package App\Http\Traits
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
trait Responsible
{
    /**
     * Create success response and return it
     *
     * @param string $message
     * @param array $data
     * @param string $status
     * @param array $headers
     * @return JsonResponse
     */
    protected  function
    successResponse(
        string $message,
        array $data = [],
        string $status = JsonResponse::HTTP_OK,
        array $headers = []): JsonResponse
    {
        $response = [
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, $status, $headers);
    }

    /**
     * Create error response and return it
     *
     * @param string $message
     * @param array $data
     * @param string $status
     * @param array $headers
     * @return JsonResponse
     */
    protected function errorResponse(
        string $message,
        array $data = [],
        string $status = JsonResponse::HTTP_BAD_REQUEST,
        array $headers = []
    ): JsonResponse
    {
        $response = [
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, $status, $headers);
    }

}
