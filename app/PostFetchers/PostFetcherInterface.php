<?php

namespace App\PostFetchers;

interface PostFetcherInterface
{
    public function getPosts(int $perPage, int $currentPage): array;
}
