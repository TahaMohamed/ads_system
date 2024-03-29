<?php

namespace App\Traits;

trait ApiResponse
{
    public function successResponse(mixed $data = null, bool $status = true, string $message = '', int $code = 200, array $additional = [], array $headers = [])
    {
        return $this->apiResponse($data, $status, $message, $code, $additional, $headers);
    }

    public function apiResponse(mixed $data = null, bool $status = true, string $message = '', int $code = 200, array $additional = [], array $headers = [])
    {
        $response = [
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ] + $additional;
        return response()->json($response, $code, $headers);
    }

    public function errorResponse(mixed $data = null, bool $status = false, string $message = '', int $code = 422, array $headers = [])
    {
        return $this->apiResponse(status: $status, message: $message, code: $code, additional: ['errors' => $data], headers: $headers);
    }


    public function paginateResponse($data, $collection)
    {
        $meta = [
            'meta' => [
                'total' => $collection->total(),
                'from' => $collection->firstItem(),
                'to' => $collection->lastItem(),
                'count' => $collection->count(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'last_page' => $collection->lastPage()
            ],
        ];
        return $this->apiResponse(data: $data, additional: $meta);
    }
}
