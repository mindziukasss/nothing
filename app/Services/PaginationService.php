<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PaginationService
{
    public function paginate($items, $perPage, $totalCount)
    {
        $currentPage = Paginator::resolveCurrentPage() ?: 1;

        $paginator = new LengthAwarePaginator(
            $items,
            $totalCount,
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return $paginator;
    }
}

