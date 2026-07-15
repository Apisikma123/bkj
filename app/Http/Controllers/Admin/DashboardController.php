<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Subsidiary;
use App\Models\Contact;
use App\Models\User;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {
        // Cache counts for 5 minutes — auto-cleared by model events when data changes
        $counts = Cache::remember('dashboard_counts', 300, function () {
            return [
                'totalSubsidiaries' => Subsidiary::count(),
                'totalUsers' => User::count(),
                'unreadMessagesCount' => Contact::where('is_read', false)->count(),
                'totalServices' => Service::count(),
                'totalTeamMembers' => TeamMember::count(),
                'totalClients' => Client::count(),
                'totalBlogs' => Blog::count(),
                'totalGalleries' => Gallery::count(),
            ];
        });

        // Recent Data (not cached — small queries, always fresh)
        $recentNews = Blog::latest()->take(5)->get();
        $recentMessages = Contact::latest()->take(5)->get();
        $latestGallery = Gallery::latest()->take(4)->get();
        
        return view('admin.dashboard', array_merge($counts, compact(
            'recentNews',
            'recentMessages',
            'latestGallery'
        )));
    }
}
