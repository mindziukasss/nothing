<?php

namespace App\PostFetchers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class CachePostFetcher implements PostFetcherInterface
{
    public function getPosts(int $perPage, int $currentPage): array
    {
        $cacheKey = 'posts_page_' . $currentPage . '_' . $perPage;
        $cacheTime = 3600;

        $posts = Cache::remember($cacheKey, $cacheTime, function () use ($perPage) {
            return Post::orderBy('created_at', 'desc')->take($perPage)->get();
        });

        return [
            'totalCount' => Post::count(),
            'posts' => $posts
        ];
    }
}
