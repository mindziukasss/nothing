<?php

namespace App\Models;

use App\PostFetchers\PostFetcherFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    public function getPosts(int $perPage = 15, int $currentPage = 1, string $functionName = 'default'): array
    {
        $postFetcher = PostFetcherFactory::create($functionName);
        return $postFetcher->getPosts($perPage, $currentPage);
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
