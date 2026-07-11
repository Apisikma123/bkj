<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Subsidiary;
use App\Models\Contact;
use App\Models\User;
class DashboardController extends Controller
{
    public function index()
    {
        // Totals
        $totalSubsidiaries = Subsidiary::count();
        $totalUsers = User::count();
        $unreadMessagesCount = Contact::where('is_read', false)->count();

        // Recent Data
        $recentNews = Blog::latest()->take(5)->get();
        $recentMessages = Contact::latest()->take(5)->get();
        $latestGallery = Gallery::latest()->take(4)->get();
        
        return view('admin.dashboard', compact(
            'totalSubsidiaries',
            'totalUsers',
            'unreadMessagesCount',
            'recentNews',
            'recentMessages',
            'latestGallery'
        ));
    }
}
