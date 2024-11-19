<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Posts extends Model
{
    /** @use HasFactory<\Database\Factories\PostsFactory> */
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'title',
        'slug',
        'content',
        'is_active',
        'uri'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }

    public function tags(): HasManyThrough
    {
        return $this->hasManyThrough(Tags::class, 'rel_posts_tags');
    }
}
