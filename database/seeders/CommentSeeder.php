<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $users = User::all();

        // Add between 0-5 comments for each post
        foreach ($posts as $post) {
            $commentCount = rand(0, 5);

            for ($i = 0; $i < $commentCount; $i++) {
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'comment' => fake()->paragraph(),
                    'created_at' => fake()->dateTimeBetween($post->created_at, 'now')
                ]);
            }
        }
    }
}
