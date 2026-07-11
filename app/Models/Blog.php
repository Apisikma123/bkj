<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'title_en', 'slug', 'content', 'content_en', 'excerpt_en', 'thumbnail', 'category', 'author_id', 'status', 'published_at', 'views'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
        });
    }
}
