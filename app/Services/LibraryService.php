<?php

namespace App\Services;
use App\Models\LibraryModel;
use CodeIgniter\HTTP\Response;
use App\Helpers\ResponseHelper;

class LibraryService
{
    protected $libraryModel;

    public function __construct()
    {
        $this->libraryModel = new LibraryModel();
    }

    public function addLibrary(array $requestData)
    {
        try {

            $requestData['uid'] = generateUid();
            if (!$this->libraryModel->insert($requestData)) {
                $errors = $this->libraryModel->errors();
                return ResponseHelper::error(
                    false,
                    $errors ? reset($errors) : 'Validation failed',
                    422,
                    $errors
                );
            }
            return ResponseHelper::success(
                true,
                'Library created successfully',
                [
                    'id' => $this->libraryModel->getInsertID(),
                    'uid' => $requestData['uid']
                ],
                201
            );
        } catch (\Throwable $e) {
            log_message('error', '[Add Library Error] ' . $e->getMessage());
            return ResponseHelper::error(
                false,
                'Something went wrong while creating library',
                500
            );
        }
    }
}



