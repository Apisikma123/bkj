<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = ['bank_name', 'account_number', 'account_name', 'subsidiary_id'];

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }

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
