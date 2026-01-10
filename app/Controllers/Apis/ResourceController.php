<?php

namespace App\Controllers\Apis;
use App\Controllers\Apis\BaseApiController;
class ResourceController extends BaseApiController
{
    public function index()
    {

        return $this->respond([
            'success' => true,
            'message' => 'Hello from index'
        ]);
    }

    public function create()
    {
        return $this->respond([
            'success' => true,
            'message' => 'create function'
        ]);
    }

    public function show($id = null)
    {
        return $this->respond([
            'success' => true,
            'id' => $id
        ]);
    }

}