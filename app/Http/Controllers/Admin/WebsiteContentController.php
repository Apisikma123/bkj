<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\CompanyProfile;
use App\Models\Setting;

class WebsiteContentController extends Controller
{
    public function index()
    {
        $hero = HeroSection::latest()->first() ?? new HeroSection();
        $profile = CompanyProfile::pluck('value', 'key')->toArray();
        $settings = Setting::pluck('value', 'key')->toArray();
        
        return view('admin.website-content.index', compact('hero', 'profile', 'settings'));
    }

    public function updateHome(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_image' => 'nullable|image|max:2048',
        ]);

        $translator = app(\App\Services\TranslationService::class);

        // Update Hero
        $hero = HeroSection::latest()->first() ?? new HeroSection();
        $hero->title = $request->input('hero_title', $hero->title);
        $hero->subtitle = $request->input('hero_subtitle', $hero->subtitle);
        
        // Auto-Translate
        if ($request->filled('hero_title')) {
            $hero->title_en = $translator->translateToEnglish($request->input('hero_title'));
        }
        if ($request->filled('hero_subtitle')) {
            $hero->subtitle_en = $translator->translateToEnglish($request->input('hero_subtitle'));
        }
        
        if ($request->hasFile('hero_image')) {
            $hero->background_image = \App\Services\ImageService::upload($request->file('hero_image'), 'hero', $hero->background_image);
        }
        
        $hero->save();

        // Update Statistics & other text in settings
        $keys = [
            'stats_clients', 'stats_projects', 'stats_years',
            'home_about_title', 'home_about_subtitle',
            'home_why_choose_us_title', 'home_why_choose_us_subtitle',
            'home_services_title', 'home_subsidiaries_title',
            'home_gallery_title', 'home_clients_title', 'home_cta_title', 'client_testimonials'
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                $val = $request->input($key);
                Setting::updateOrCreate(['key' => $key], ['value' => $val]);
                
                if (!empty($val)) {
                    $valEn = $translator->translateToEnglish($val);
                    Setting::updateOrCreate(['key' => $key . '_en'], ['value' => $valEn]);
                }
                
                // We'll also clear cache to ensure frontend sees it
                \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
                \Illuminate\Support\Facades\Cache::forget('home_page_data');
            }
        }

        return redirect()->route('admin.content.index')->with('success', 'Home content updated successfully.');
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'history' => 'nullable|string',
            'about_image' => 'nullable|image|max:2048',
        ]);

        $translator = app(\App\Services\TranslationService::class);

        $keys = [
            'name', 'description', 'vision', 'mission', 'history'
        ];
        
        foreach ($keys as $key) {
            if ($request->has($key)) {
                $val = $request->input($key);
                CompanyProfile::updateOrCreate(['key' => $key], ['value' => $val]);
                
                // Auto translate for the _en version
                if (!empty($val)) {
                    if ($key === 'name') {
                        $valEn = $val; // Do not translate company name
                    } else {
                        $valEn = $translator->translateToEnglish($val);
                    }
                    CompanyProfile::updateOrCreate(['key' => $key . '_en'], ['value' => $valEn]);
                }
            }
        }
        
        $settingKeys = ['team_members', 'company_legality'];
        foreach ($settingKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $request->input($key)]);
            }
        }
        
        if ($request->hasFile('about_image')) {
            $oldImage = CompanyProfile::where('key', 'image')->value('value');
            $newImage = \App\Services\ImageService::upload($request->file('about_image'), 'about', $oldImage);
            CompanyProfile::updateOrCreate(['key' => 'image'], ['value' => $newImage]);
        }
        
        \Illuminate\Support\Facades\Cache::forget('home_page_data_html');
        \Illuminate\Support\Facades\Cache::forget('home_page_data');

        return redirect()->route('admin.content.index')->with('success', 'About Us content updated successfully.');
    }

    public function updateGallery(Request $request)
    {
        Setting::updateOrCreate(['key' => 'gallery_page_title'], ['value' => $request->input('gallery_page_title')]);
        return redirect()->route('admin.content.index')->with('success', 'Gallery settings updated.');
    }
    public function updateContact(Request $request)
    {
        $keys = ['contact_email', 'contact_phone1', 'contact_phone2', 'contact_address', 'contact_map_url'];
        $translator = app(\App\Services\TranslationService::class);
        foreach ($keys as $key) {
            if ($request->has($key)) {
                $val = $request->input($key);
                Setting::updateOrCreate(['key' => $key], ['value' => $val]);
                
                if (!empty($val)) {
                    $valEn = $translator->translateToEnglish($val);
                    Setting::updateOrCreate(['key' => $key . '_en'], ['value' => $valEn]);
                }
            }
        }
        return redirect()->route('admin.content.index')->with('success', 'Contact content updated successfully.');
    }

    public function updateFooter(Request $request)
    {
        $keys = ['footer_about_text', 'footer_copyright', 'social_facebook', 'social_instagram', 'social_linkedin'];
        $translator = app(\App\Services\TranslationService::class);
        foreach ($keys as $key) {
            if ($request->has($key)) {
                $val = $request->input($key);
                Setting::updateOrCreate(['key' => $key], ['value' => $val]);
                
                if (!empty($val)) {
                    $valEn = $translator->translateToEnglish($val);
                    Setting::updateOrCreate(['key' => $key . '_en'], ['value' => $valEn]);
                }
            }
        }
        return redirect()->route('admin.content.index')->with('success', 'Footer content updated successfully.');
    }
}
