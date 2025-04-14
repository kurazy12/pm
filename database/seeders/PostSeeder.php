<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Province;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->pluck('id')->toArray();
        $provinces = Province::pluck('id')->toArray();
        $statuses = ['pending', 'in_progress', 'resolved'];

        for ($i = 0; $i < 50; $i++) {
            $status = $statuses[array_rand($statuses)];
            $statusNote = null;

            if ($status === 'in_progress') {
                $statusNote = 'Sedang dalam proses penanganan oleh staff terkait.';
            } else if ($status === 'resolved') {
                $statusNote = 'Pengaduan telah ditangani dan diselesaikan.';
            }

            Post::create([
                'user_id' => $users[array_rand($users)],
                'province_id' => $provinces[array_rand($provinces)],
                'title' => 'Pengaduan ' . fake()->sentence(4),
                'content' => fake()->paragraphs(3, true),
                'status' => $status,
                'views' => fake()->numberBetween(0, 500),
                'likes' => fake()->numberBetween(0, 100),
                'image_path' => 'https://picsum.photos/600/300',
                'status_note' => $statusNote,
                'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
            ]);
        }
    }
}
