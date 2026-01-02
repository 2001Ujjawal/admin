<?php

namespace App\Controllers\Apis;

use App\Controllers\Apis\BaseApiController;
use App\Services\{LibrariesService, LibraryAuthService};

class LibraryApiController extends BaseApiController
{

    protected LibrariesService $libraryService;
    protected LibraryAuthService $libraryAuthService;
    protected array $loggedUserDetails;
    protected string $loggedUserId;

    public function __construct()
    {
        $this->libraryService = new LibrariesService();
        $this->libraryAuthService = new LibraryAuthService();
        $this->loggedUserDetails = $this->getLoggedUserDetails();
        $this->loggedUserId = $this->loggedUserId();
    }

    public function addLibrary()
    {
        $requestData = $this->request->getJSON(true) ?? [];
        $libraryCreation = $this->libraryService->addLibrary($requestData);
        return $this->sendApiResponse($libraryCreation);
    }
    public function login()
    {
        $requestData = $this->request->getJSON(true) ?? [];
        $login = $this->libraryAuthService->login($requestData);
        return $this->sendApiResponse($login);
    }

    public function logout()
    {
        $requestData = $this->request->getJSON(true) ?? [];
        $logout = $this->libraryAuthService->logout($requestData);
        return $this->sendApiResponse($logout);
    }

    public function loginSessionList() {}
}
