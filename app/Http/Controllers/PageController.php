<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\HeroSection;
use App\Models\CompanyProfile;
use App\Models\Subsidiary;
use App\Models\Gallery;
use App\Models\Blog;

class PageController extends Controller
{
    public function home()
    {
        $data = Cache::remember('home_page_data', 3600, function () {
            return [
                'hero' => HeroSection::latest()->first(),
                'blogs' => Blog::with('author')->where('status', 'published')->latest()->limit(3)->get(),
                'galleries' => Gallery::where('status', 'published')->latest()->limit(6)->get(),
                'services' => \App\Models\Service::where('status', 'published')->get(),
                'clients' => \App\Models\Client::where('status', 'published')->get(),
                'subsidiariesList' => Subsidiary::all(),
            ];
        });
        
        return view('welcome', $data);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        $services = \App\Models\Service::where('status', 'published')->get();
        return view('pages.services', compact('services'));
    }

    public function showSubsidiary($slug)
    {
        $subsidiary = Subsidiary::where('slug', $slug)->first();

        // Fallback: If exact slug not found, try to slugify the input (e.g., if user typed "PT batam-kepri-jaya")
        if (!$subsidiary) {
            $slugified = \Illuminate\Support\Str::slug($slug);
            $subsidiary = Subsidiary::where('slug', $slugified)->firstOrFail();
            
            // Redirect to the correct canonical URL
            return redirect()->route('subsidiaries.show', $subsidiary->slug);
        }
        
        if (!empty($subsidiary->url) && filter_var($subsidiary->url, FILTER_VALIDATE_URL)) {
            return redirect()->away($subsidiary->url);
        }

        return view('pages.subsidiaries.show', compact('subsidiary'));
    }

    public function gallery()
    {
        $galleries = Gallery::where('status', 'published')->latest()->paginate(12);
        return view('pages.gallery', compact('galleries'));
    }

    public function blog()
    {
        $blogs = Blog::with('author')->where('status', 'published')->latest()->paginate(9);
        return view('pages.blog', compact('blogs'));
    }

    public function clients()
    {
        return view('pages.clients');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'business_unit' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
            'cf-turnstile-response' => [app()->environment('testing') || empty(env('TURNSTILE_SECRET_KEY')) ? 'nullable' : 'required', new \App\Rules\Turnstile()],
        ]);

        // Defensive: If the database hasn't been migrated yet to add the business_unit column,
        // we prepend the selected business unit to the message body so the application does not crash
        // and you still receive the selected business unit information.
        if (!empty($validated['business_unit']) && !\Illuminate\Support\Facades\Schema::hasColumn('contacts', 'business_unit')) {
            $validated['message'] = "Target Unit: " . $validated['business_unit'] . "\n\n" . $validated['message'];
            unset($validated['business_unit']);
        }

        \App\Models\Contact::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
    }

    public function showBlog($slug)
    {
        $blog = Blog::with('author')->where('slug', $slug)->where('status', 'published')->first();

        // Fallback: If exact slug not found, try to slugify the input
        if (!$blog) {
            $slugified = \Illuminate\Support\Str::slug($slug);
            $blog = Blog::with('author')->where('slug', $slugified)->where('status', 'published')->firstOrFail();
            
            // Redirect to the correct canonical URL
            return redirect()->route('blog.show', $blog->slug);
        }

        return view('pages.blog-show', compact('blog'));
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function sitemap()
    {
        return view('pages.sitemap');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $results = collect();
        if ($query) {
            $results = Blog::where('status', 'published')
                           ->where(function ($q) use ($query) {
                               $q->where('title', 'like', '%' . $query . '%')
                                 ->orWhere('content', 'like', '%' . $query . '%');
                           })
                           ->get();
        }
        return view('pages.search', compact('results', 'query'));
    }
}
