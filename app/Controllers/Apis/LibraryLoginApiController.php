<?php

namespace App\Controllers\Apis;

use App\Controllers\Apis\BaseApiController;
use App\Services\{LibrariesService, LibraryAuthService};

class LibraryLoginApiController extends BaseApiController
{
    protected LibraryAuthService $libraryAuthService;
    public function __construct()
    {
        $this->libraryAuthService = new LibraryAuthService();
    }


    public function login()
    {
        $requestData = $this->request->getJSON(true) ?? [];
        $login = $this->libraryAuthService->login($requestData);
        return $this->sendApiResponse($login);
    }
}
