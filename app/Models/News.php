<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'news';
    protected $with = ['author'];

    protected $casts = [
        'images' => 'array',
    ];

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
