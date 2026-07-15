<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type'];

    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
            \Illuminate\Support\Facades\Cache::forget('global_settings');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
            \Illuminate\Support\Facades\Cache::forget('global_settings');
        });
    }
}
