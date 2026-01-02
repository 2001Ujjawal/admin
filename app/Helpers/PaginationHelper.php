<?php

namespace App\Helpers;

class PaginationHelper
{
    public static function applyPagination($builder, array $filters): array
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
