<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;

class MediaService
{
    /**
     * Store and process an uploaded file. Converts images to WebP and compresses.
     * 
     * @param UploadedFile $file
     * @param string $directory
     * @return array
     */
    public function storeAndProcess(UploadedFile $file, string $directory = 'media')
    {
        $originalName = $file->getClientOriginalName();
        $filename = pathinfo($originalName, PATHINFO_FILENAME);
        $mimeType = $file->getMimeType();
        $size = $file->getSize();

        // Check if it's an image
        if (Str::startsWith($mimeType, 'image/') && !in_array($mimeType, ['image/svg+xml', 'image/gif'])) {
            try {
                $manager = new ImageManager(new Driver());
                $image = $manager->decode($file->getRealPath());
                
                // We encode to WebP with 80% quality using Intervention v4 WebpEncoder
                $encoded = $image->encode(new \Intervention\Image\Encoders\WebpEncoder(quality: 80));
                
                $safeFilename = Str::slug($filename) . '-' . uniqid() . '.webp';
                $path = $directory . '/' . $safeFilename;
                
                Storage::disk('public')->put($path, (string) $encoded);
                
                return [
                    'filename' => $safeFilename,
                    'path' => $path,
                    'mime_type' => 'image/webp',
                    'size' => Storage::disk('public')->size($path),
                    'alt_text' => str_replace('-', ' ', Str::slug($filename))
                ];
            } catch (Exception $e) {
                // If intervention fails (e.g., unsupported format), fallback to raw store
            }
        }

        // Fallback or non-image files
        $extension = $file->getClientOriginalExtension();
        $safeFilename = Str::slug($filename) . '-' . uniqid() . '.' . $extension;
        $path = $file->storeAs($directory, $safeFilename, 'public');

        return [
            'filename' => $safeFilename,
            'path' => $path,
            'mime_type' => $mimeType,
            'size' => $size,
            'alt_text' => str_replace('-', ' ', Str::slug($filename))
        ];
    }
}
