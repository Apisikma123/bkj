<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class TranslationService
{
    /**
     * Translate Indonesian text to English automatically.
     * 
     * @param string|null $text
     * @return string|null
     */
    public function translateToEnglish(?string $text): ?string
    {
        if (empty(trim($text))) {
            return null;
        }

        $cacheKey = 'translation_id_en_' . md5($text);

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $tr = new GoogleTranslate();
            $tr->setSource('id');
            $tr->setTarget('en');
            
            $translated = $tr->translate($text);
            
            if ($translated !== null && $translated !== $text) {
                Cache::forever($cacheKey, $translated);
            }
            return $translated;
            
        } catch (\Exception $e) {
            Log::error('Auto-translation failed: ' . $e->getMessage());
            // Fallback to original text if API fails. Do not cache the fallback.
            return $text;
        }
    }
}
