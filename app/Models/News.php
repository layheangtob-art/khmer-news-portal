<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'news';
    protected $with = ['author'];

    protected $casts = [
        'images' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function (News $news) {
            if (blank($news->slug)) {
                $news->slug = static::generateUniqueSlug((string) $news->title, $news->id);
            }
        });
    }

    /**
     * Build a URL-safe, unique slug from a news title.
     */
    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = static::makeSlug($title);
        $base = $base !== '' ? $base : 'news';

        $slug = $base;
        $suffix = 1;

        while (true) {
            $query = static::where('slug', $slug);

            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }

            if (! $query->exists()) {
                break;
            }

            $slug = $base.'-'.(++$suffix);
        }

        return $slug;
    }

    /**
     * Convert a title into a slug while keeping Khmer and Latin letters intact.
     */
    public static function makeSlug(string $title): string
    {
        $slug = preg_replace('/[^\p{L}\p{M}\p{N}]+/u', '-', $title) ?? '';
        $slug = mb_strtolower(trim($slug, '-'), 'UTF-8');

        return trim(Str::limit($slug, 120, ''), '-');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Helper method to get all images (main + additional images)
    public function getAllImages()
    {
        $allImages = [];

        // Add main image if exists
        if ($this->image) {
            $allImages[] = $this->image;
        }

        // Add additional images if exists
        if ($this->images && is_array($this->images)) {
            $allImages = array_merge($allImages, $this->images);
        }

        return $allImages;
    }
}
