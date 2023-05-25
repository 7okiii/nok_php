<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::insert([
            [
                'user_id' => '1',
                'title' => 'Laravel',
                'contents' => 'あいうえお',
                'contents_of_html' => '<p>あいうえお<br/>かきくけこ</p>',
                'post_type_id' => 1,
                'post_title_img_path' => null,
                'is_display' => 1,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'title' => 'React',
                'contents' => 'えええええ',
                'contents_of_html' => '<p>えええええ<br/>いいいいい</p>',
                'post_type_id' => 2,
                'post_title_img_path' => null,
                'is_display' => 1,
                'created_user_id' => 2,
                'updated_user_id' => 2,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
