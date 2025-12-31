<?php

namespace App\Controllers\Apis;

use App\Controllers\Apis\BaseApiController;
use App\Services\{
    LibraryService,
};
class LibraryApiController extends BaseApiController
{
    protected $libraryService;

    public function __construct()
    {
        $this->libraryService = new LibraryService();
    }
    public function addLibrary()
    {
        $requestData = $this->request->getJSON(true);
        $libraryCreation = $this->libraryService->addLibrary($requestData);
        return $this->sendApiResponse($libraryCreation);
        
    }
}   
