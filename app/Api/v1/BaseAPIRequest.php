<?php

namespace App\Api\v1;

use Illuminate\Http\Request;

abstract class BaseAPIRequest
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var mixed
     */
    protected $limit = 'all';

    /**
     * @var int
     */
    protected $itemsPerPage = 10;

    /**
     * Create a new API Request instance
     *
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Returns JSON Formatted response
     * 
     * @param string $message
     * @param string $status
     * @param int $code
     * @param mixed $data
     *
     * @return \Illuminate\Http\Response
     */
    protected function response($message, $status, $code, $data = null)
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Paginate API Response
     *
     * @return Collection
     */
    abstract protected function paginate();

    /**
     * Get all resource
     *
     * @return Collection
     */
    abstract protected function getAllResource();

    /**
     * Get an API Resource by their ID
     *
     * @return Collection
     */
    abstract protected function getResourceByID($resourceID);
}