<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tags::class, 'rel_posts_tags', 'post_id', 'tag_id');
    }

    protected static function booted(): void
    {
        static::created(function (Posts $post) {
            $post->uri ??= "$post->slug-$post->id";
            $post->save();
        });
    }
}
