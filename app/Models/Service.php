<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'title_en',
        'short_description',
        'short_description_en',
        'content',
        'content_en',
        'icon',
        'image_path',
        'status',
    ];

    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
            \Illuminate\Support\Facades\Cache::forget('services_list');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
            \Illuminate\Support\Facades\Cache::forget('services_list');
        });
    }
}
