<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'logo_path',
        'status',
    ];

    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
            \Illuminate\Support\Facades\Cache::forget('clients_list');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
            \Illuminate\Support\Facades\Cache::forget('home_page_data');
            \Illuminate\Support\Facades\Cache::forget('clients_list');
        });
    }
}
