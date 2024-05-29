<?php

namespace App\PostFetchers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class NotEloquentPostFetcher implements PostFetcherInterface
{
    public function getPosts(int $perPage, int $currentPage): array
    {
        return [
            'totalCount' => Post::count(),
            'posts' => DB::select("SELECT * FROM posts ORDER BY created_at LIMIT ?", [$perPage])
        ];
    }
}
