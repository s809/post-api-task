<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Posts;
use App\Models\Tags;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->createMany([
            ["name" => "Вася"],
            ["name" => "Петя"]
        ]);

        Tags::factory()->createMany([
            ["title" => "Новости", "slug" => "news"],
            ["title" => "Статьи", "slug" => "articles"],
        ]);

        $createdPosts = Posts::factory()->createMany([
            [
                "title" => "Новость 1 Заголовок",
                "content" => "Новость 1 Текст",
                "slug" => "news-1",
                "is_active" => true,
                "owner_id" => 1,
                "created_at" => "26.03.2024 10:00:00",
                "updated_at" => "26.03.2024 10:00:00",
            ],
            [
                "title" => "Новость 2 Заголовок",
                "content" => "Новость 2 Текст",
                "slug" => "news-2",
                "is_active" => false,
                "owner_id" => 1,
                "created_at" => "27.03.2024 11:00:00",
                "updated_at" => "27.03.2024 11:00:00",
            ],
            [
                "title" => "Новость 3 Заголовок",
                "content" => "Новость 3 Текст",
                "slug" => "news-3",
                "is_active" => true,
                "owner_id" => 2,
                "created_at" => "28.03.2024 12:00:00",
                "updated_at" => "28.03.2024 12:00:00",
            ],
            [
                "title" => "Новость 4 Заголовок",
                "content" => "Новость 4 Текст",
                "slug" => "news-4",
                "is_active" => false,
                "owner_id" => 2,
                "created_at" => "29.03.2024 13:00:00",
                "updated_at" => "29.03.2024 13:00:00",
            ],
            [
                "title" => "Статья 1 Заголовок",
                "content" => "Статья 1 Текст",
                "slug" => "article-1",
                "is_active" => true,
                "owner_id" => 1,
                "created_at" => "01.03.2024 18:00:00",
                "updated_at" => "01.03.2024 18:00:00",
            ],
            [
                "title" => "Статья 2 Заголовок",
                "content" => "Статья 2 Текст",
                "slug" => "article-2",
                "is_active" => false,
                "owner_id" => 1,
                "created_at" => "11.03.2024 14:00:00",
                "updated_at" => "11.03.2024 14:00:00",
            ],
            [
                "title" => "Статья 3 Заголовок",
                "content" => "Статья 3 Текст",
                "slug" => "article-3",
                "is_active" => true,
                "owner_id" => 2,
                "created_at" => "16.03.2024 16:00:00",
                "updated_at" => "16.03.2024 16:00:00",
            ],
            [
                "title" => "Статья 4 Заголовок",
                "content" => "Статья 4 Текст",
                "slug" => "article-4",
                "is_active" => true,
                "owner_id" => 2,
                "created_at" => "21.03.2024 12:00:00",
                "updated_at" => "21.03.2024 12:00:00",
            ],
        ]);

        for ($i = 0; $i < 4; $i++) {
            $createdPosts->get($i)->tags()->attach(1);
            $createdPosts->get($i + 4)->tags()->attach(2);
        }
    }
}
