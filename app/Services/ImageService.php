<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Upload an image, convert to WebP, compress, and delete old image.
     *
     * @param UploadedFile $file The uploaded file
     * @param string $directory The target directory inside public storage (e.g., 'galleries')
     * @param string|null $oldPath The old file path to delete
     * @param int $maxWidth Max width to scale down
     * @return string The stored file path (e.g., 'public/galleries/img_xxx.webp')
     */
    public static function upload(UploadedFile $file, string $directory = 'uploads', ?string $oldPath = null, int $maxWidth = 1920): string
    {
        // Delete old file if provided
        if ($oldPath) {
            self::delete($oldPath);
        }

        // Generate unique name
        $filename = uniqid('img_') . '_' . time() . '_' . Str::random(5) . '.webp';
        $relativePath = $directory . '/' . $filename;

        // Make sure directory exists
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        try {
            if (class_exists(ImageManager::class)) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file->getRealPath());
                
                // Resize if too large
                if ($image->width() > $maxWidth) {
                    $image->scaleDown(width: $maxWidth);
                }
                
                // Encode to webp with 80% quality
                $encoded = $image->toWebp(80);
                
                // Save to storage
                Storage::disk('public')->put($relativePath, (string) $encoded);
                return $relativePath;
            }
        } catch (\Throwable $e) {
            // Log error silently and fallback to standard upload
            \Log::warning("ImageService WebP conversion failed: " . $e->getMessage());
        }

        return $file->store($directory, 'public');
    }

    /**
     * Delete an image from storage safely.
     *
     * @param string|null $path
     * @return void
     */
    public static function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
