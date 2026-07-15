<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'title_en', 'image_path', 'category', 'category_en', 'status', 'is_featured'];

    // No relationships as category is now a string field

    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
        });
    }
}
