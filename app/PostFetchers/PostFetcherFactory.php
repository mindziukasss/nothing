<?php

namespace App\PostFetchers;

class PostFetcherFactory
{
    public static function create(string $functionName): PostFetcherInterface
    {
        switch ($functionName) {
            case 'chunk':
                return new ChunkPostFetcher();
            case 'notEloquent':
                return new NotEloquentPostFetcher();
            case 'cache':
                return new CachePostFetcher();
            case 'default':
            default:
                return new DefaultPostFetcher();
        }
    }
}
