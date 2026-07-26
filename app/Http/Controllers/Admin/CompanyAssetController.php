<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subsidiary;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CompanyAssetController extends Controller
{
    /**
     * Display a listing of company assets.
     */
    public function index()
    {
        // Load all subsidiaries (the 3 distinct companies)
        $subsidiaries = Subsidiary::all();
        return view('admin.company-assets.index', compact('subsidiaries'));
    }

    /**
     * Update the global assets (All Pages / BKJ Group).
     */
    public function updateGlobal(Request $request)
    {
        $request->validate([
            'icon' => [
                'nullable',
                'file',
                'max:2048', // max 2MB
                function ($attribute, $value, $fail) {
                    $ext = strtolower($value->getClientOriginalExtension());
                    if (!in_array($ext, ['ico', 'png', 'svg'])) {
                        $fail('The ' . $attribute . ' must be a file of type: ico, png, svg.');
                    }
                }
            ],
            'favicon' => [
                'nullable',
                'file',
                'max:2048', // max 2MB
                function ($attribute, $value, $fail) {
                    $ext = strtolower($value->getClientOriginalExtension());
                    if (!in_array($ext, ['ico', 'png', 'svg'])) {
                        $fail('The ' . $attribute . ' must be a file of type: ico, png, svg.');
                    }
                }
            ],
        ]);

        $globalIconSetting = Setting::firstOrCreate(['key' => 'global_icon'], ['type' => 'text']);
        $globalFaviconSetting = Setting::firstOrCreate(['key' => 'global_favicon'], ['type' => 'text']);
        $updated = false;

        // Handle Global Icon Upload
        if ($request->hasFile('icon')) {
            // Delete old icon file if exists
            if ($globalIconSetting->value && Storage::disk('public')->exists($globalIconSetting->value)) {
                Storage::disk('public')->delete($globalIconSetting->value);
            }

            // Store new icon file
            $iconFile = $request->file('icon');
            $iconExt = strtolower($iconFile->getClientOriginalExtension());
            $iconName = 'icon_global_' . time() . '.' . $iconExt;
            $iconPath = 'companies/icons/' . $iconName;

            // Compress PNG via resizing
            if ($iconExt === 'png' && class_exists(ImageManager::class)) {
                try {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($iconFile->getRealPath());
                    
                    if ($image->width() > 512 || $image->height() > 512) {
                        $image->scaleDown(width: 512, height: 512);
                    }
                    
                    $encoded = $image->toPng();
                    Storage::disk('public')->put($iconPath, (string) $encoded);
                } catch (\Throwable $e) {
                    \Log::warning("Global Icon compression failed: " . $e->getMessage());
                    $iconFile->storeAs('companies/icons', $iconName, 'public');
                }
            } else {
                $iconFile->storeAs('companies/icons', $iconName, 'public');
            }

            $globalIconSetting->value = $iconPath;
            $globalIconSetting->save();
            $updated = true;
        }

        // Handle Global Favicon Upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon file if exists
            if ($globalFaviconSetting->value && Storage::disk('public')->exists($globalFaviconSetting->value)) {
                Storage::disk('public')->delete($globalFaviconSetting->value);
            }

            // Store new favicon file
            $favFile = $request->file('favicon');
            $favExt = strtolower($favFile->getClientOriginalExtension());
            $favName = 'favicon_global_' . time() . '.' . $favExt;
            $favPath = 'companies/favicons/' . $favName;

            // Crop and resize to 192x192 square (multiple of 48px for Google guidelines)
            if (in_array($favExt, ['png', 'jpg', 'jpeg', 'webp']) && class_exists(ImageManager::class)) {
                try {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($favFile->getRealPath());
                    
                    // Enforce square aspect ratio and resize to 192x192
                    $image->cover(192, 192);
                    
                    $encoded = ($favExt === 'webp') ? $image->toWebp() : (($favExt === 'png') ? $image->toPng() : $image->toJpeg());
                    Storage::disk('public')->put($favPath, (string) $encoded);
                } catch (\Throwable $e) {
                    \Log::warning("Global Favicon processing failed: " . $e->getMessage());
                    $favFile->storeAs('companies/favicons', $favName, 'public');
                }
            } else {
                $favFile->storeAs('companies/favicons', $favName, 'public');
            }

            // Copy to public/favicon.ico so direct root requests and crawlers fetch the correct file
            try {
                $publicFaviconPath = public_path('favicon.ico');
                if (Storage::disk('public')->exists($favPath)) {
                    $faviconContent = Storage::disk('public')->get($favPath);
                    file_put_contents($publicFaviconPath, $faviconContent);
                }
            } catch (\Throwable $e) {
                \Log::error("Failed to copy global favicon to public/favicon.ico: " . $e->getMessage());
            }

            $globalFaviconSetting->value = $favPath;
            $globalFaviconSetting->save();
            $updated = true;
        }

        if ($updated) {
            Cache::forget('global_settings');
            Cache::forget('home_page_data');
            Cache::forget('home_page_data_html');
            Cache::forget('company_profile');

            return redirect()->back()->with('success', 'Global company assets updated successfully.');
        }

        return redirect()->back()->with('info', 'No assets were updated.');
    }

    /**
     * Update the company assets (Icon & Favicon) for a specific subsidiary.
     */
    public function update(Request $request, Subsidiary $subsidiary)
    {
        $request->validate([
            'icon' => [
                'nullable',
                'file',
                'max:2048', // max 2MB
                function ($attribute, $value, $fail) {
                    $ext = strtolower($value->getClientOriginalExtension());
                    if (!in_array($ext, ['ico', 'png', 'svg'])) {
                        $fail('The ' . $attribute . ' must be a file of type: ico, png, svg.');
                    }
                }
            ],
            'favicon' => [
                'nullable',
                'file',
                'max:2048', // max 2MB
                function ($attribute, $value, $fail) {
                    $ext = strtolower($value->getClientOriginalExtension());
                    if (!in_array($ext, ['ico', 'png', 'svg'])) {
                        $fail('The ' . $attribute . ' must be a file of type: ico, png, svg.');
                    }
                }
            ],
        ]);

        $updated = false;

        // Handle Icon Upload
        if ($request->hasFile('icon')) {
            // Delete old icon file if exists
            if ($subsidiary->icon_path && Storage::disk('public')->exists($subsidiary->icon_path)) {
                Storage::disk('public')->delete($subsidiary->icon_path);
            }

            // Store new icon file
            $iconFile = $request->file('icon');
            $iconExt = strtolower($iconFile->getClientOriginalExtension());
            $iconName = 'icon_' . $subsidiary->slug . '_' . time() . '.' . $iconExt;
            $iconPath = 'companies/icons/' . $iconName;

            // Compress PNG via resizing
            if ($iconExt === 'png' && class_exists(ImageManager::class)) {
                try {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($iconFile->getRealPath());
                    
                    if ($image->width() > 512 || $image->height() > 512) {
                        $image->scaleDown(width: 512, height: 512);
                    }
                    
                    $encoded = $image->toPng();
                    Storage::disk('public')->put($iconPath, (string) $encoded);
                } catch (\Throwable $e) {
                    \Log::warning("Icon compression failed: " . $e->getMessage());
                    $iconFile->storeAs('companies/icons', $iconName, 'public');
                }
            } else {
                $iconFile->storeAs('companies/icons', $iconName, 'public');
            }

            $subsidiary->icon_path = $iconPath;
            $updated = true;
        }

        // Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon file if exists
            if ($subsidiary->favicon_path && Storage::disk('public')->exists($subsidiary->favicon_path)) {
                Storage::disk('public')->delete($subsidiary->favicon_path);
            }

            // Store new favicon file
            $favFile = $request->file('favicon');
            $favExt = strtolower($favFile->getClientOriginalExtension());
            $favName = 'favicon_' . $subsidiary->slug . '_' . time() . '.' . $favExt;
            $favPath = 'companies/favicons/' . $favName;

            // Crop and resize to 192x192 square (multiple of 48px for Google guidelines)
            if (in_array($favExt, ['png', 'jpg', 'jpeg', 'webp']) && class_exists(ImageManager::class)) {
                try {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($favFile->getRealPath());
                    
                    // Enforce square aspect ratio and resize to 192x192
                    $image->cover(192, 192);
                    
                    $encoded = ($favExt === 'webp') ? $image->toWebp() : (($favExt === 'png') ? $image->toPng() : $image->toJpeg());
                    Storage::disk('public')->put($favPath, (string) $encoded);
                } catch (\Throwable $e) {
                    \Log::warning("Favicon processing failed: " . $e->getMessage());
                    $favFile->storeAs('companies/favicons', $favName, 'public');
                }
            } else {
                $favFile->storeAs('companies/favicons', $favName, 'public');
            }

            $subsidiary->favicon_path = $favPath;
            $updated = true;
        }

        if ($updated) {
            $subsidiary->save();

            // Clear cache to reflect updates instantly
            Cache::forget('global_subsidiaries');
            Cache::forget('home_page_data');
            Cache::forget('home_page_data_html');
            Cache::forget('company_profile');
            
            return redirect()->back()->with('success', 'Assets for ' . $subsidiary->name . ' updated successfully.');
        }

        return redirect()->back()->with('info', 'No assets were updated.');
    }
}
