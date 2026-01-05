<?php

namespace App\Models;

use App\Helpers\PaginationHelper;
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
        'status',
        'type'
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
        $pagination = PaginationHelper::applyPagination($builder, $filters);
        $loginSessions = $builder->get()->getResultArray();

        return [
            'loginSessions'      => $loginSessions,
            'pagination' => $pagination,
        ];
    }
}
