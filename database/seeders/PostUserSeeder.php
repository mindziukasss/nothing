<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PostUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::chunk(100, function ($users) {
            foreach ($users as $user) {
                $posts = Post::inRandomOrder()->take(rand(1, 10))->get();
                foreach ($posts as $post) {
                    $user->posts()->attach($post->id);
                }
            }
        });
    }
}
