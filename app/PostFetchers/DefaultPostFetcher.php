<?php

namespace App\PostFetchers;

use App\Models\Post;

class DefaultPostFetcher implements PostFetcherInterface
{
    public function getPosts(int $perPage, int $currentPage): array
    {
        $offset = ($currentPage - 1) * $perPage;
        return [
            'totalCount' => Post::count(),
            'posts' => Post::orderBy('created_at')->skip($offset)->take($perPage)->get()
        ];
    }
}
