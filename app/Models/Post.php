<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_like_post')->withTimestamps();
    }

    public function categorys(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_post')->withTimestamps();
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeWithCategory(Builder $query, string $category)
    {
        return $query->whereHas('categorys', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }

    public function scopeFeatured(Builder $query)
    {
        return $query->where('featured', true);
    }

    public function scopePopular(Builder $query)
    {
        return $query->withCount('likes')
            ->orderBy('likes_count', 'desc');
    }

    public function scopeSearch(Builder $query, $search = '')
    {
        return $query->where('title', 'like', "%{$search}%");
    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body), 150);
    }

    public function getReadingTime()
    {
        $mins = round(str_word_count($this->body) / 250);

        return ($mins < 1) ? 1 : $mins;
    }

    public function imageUrl()
    {
        return (str_contains($this->image, 'http')) ? $this->image : Storage::url($this->image);
    }
}
