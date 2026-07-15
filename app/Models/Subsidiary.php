<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
    protected $fillable = [
        'name', 'name_en', 'slug', 'description', 'description_en', 
        'content', 'content_en', 'url', 'hero_image', 'icon_path', 'favicon_path'
    ];

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
            \Illuminate\Support\Facades\Cache::forget('global_subsidiaries');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
            \Illuminate\Support\Facades\Cache::forget('global_subsidiaries');
        });
    }
}
