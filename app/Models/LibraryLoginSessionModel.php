<?php

namespace App\Models;

use CodeIgniter\Model;

class LibraryLoginSessionModel extends Model
{
    protected $table = 'library_login_sessions';
    protected $primaryKey   = 'id';
    protected $allowedFields  = [
        'uid',
        'library_id',
        'email',
        'phone_no',
        'is_login',
        'login_details',
        'created_at',
        'status'
    ];


    public function loginSessionCount(string $libraryId): int
    {
        $countConditions = [
            'library_id' => $libraryId,
            'status'     => STATUS_ACTIVE,
            'is_login'   => 1
        ];
        $countLibraryAllSession = $this->where($countConditions)->countAllResults();
        return $countLibraryAllSession;
    }


    public function logout(array $logoutPayload): bool
    {
        $updateValues = [
            'is_login' => 0
        ];
        $logout = $this->set($updateValues)->where($logoutPayload)->update();

        if (!$logout) {
            return false;
        }
        return true;
    }


    public function sessionListByLibraryId(string $libraryId, ?array $filters): array
    {
        $builder = $this->builder();
        $builder->where('library_id', $libraryId);

        if (!empty($filters['is_login'])) {
            $builder->where('is_login', $filters['is_login']);
        }
        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }

        $builder->orderBy('created_at', $filters['order_by_created_at']);
        $pagination = $this->applyPagination($builder, $filters);
        $loginSessions = $builder->get()->getResultArray();

        return [
            'loginSessions'      => $loginSessions,
            'pagination' => $pagination,
        ];
    }


    public  function applyPagination($builder, array $filters)
    {
        $page     = max(1, (int)($filters['pageNumber'] ?? 1));
        $pageSize = max(1, min(100, (int)($filters['pageSize'] ?? 10)));

      
        $countBuilder = clone $builder;
        $totalRecords = $countBuilder->countAllResults();

        $totalPages = (int) ceil($totalRecords / $pageSize);
        $offset     = ($page - 1) * $pageSize;

        
        $builder->limit($pageSize, $offset);

        return [
            'pageNumber'  => $page,
            'pageSize'    => $pageSize,
            'totalPages'  => $totalPages,
            'totalRecords' => $totalRecords,
        ];
    }
}
