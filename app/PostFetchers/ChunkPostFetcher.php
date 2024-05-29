<?php

namespace App\PostFetchers;

use App\Models\Post;

class ChunkPostFetcher implements PostFetcherInterface
{
    public function getPosts(int $perPage, int $currentPage): array
    {
        $processedPosts = [];
        $processedCount = 0;

        Post::orderBy('created_at')->chunk($perPage, function ($chunkPosts) use (&$processedPosts, &$processedCount, $perPage) {
            foreach ($chunkPosts as $post) {
                $processedCount++;
                $processedPosts[] = $post->toArray();

                if ($processedCount >= $perPage) {
                    return false;
                }
            }
        });

        return [
            'totalCount' => Post::count(),
            'posts' => $processedPosts
        ];
    }
}

