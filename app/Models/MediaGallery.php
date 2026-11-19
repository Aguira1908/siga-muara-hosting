<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaGallery extends Model
{
    protected $fillable = [
        'type', 'category', 'title', 'description',
        'file_path', 'video_url', 'thumbnail_path',
        'sort_order', 'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order'   => 'integer',
    ];

    public function scopePublished($q)
    {
        return $q->where('is_published', true);
    }

    public function scopeOfCategory($q, $category)
    {
        return $q->where('category', $category);
    }
}