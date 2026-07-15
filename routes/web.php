<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/services', [\App\Http\Controllers\PageController::class, 'services'])->name('services');
Route::get('/gallery', [\App\Http\Controllers\PageController::class, 'gallery'])->name('gallery');
Route::get('/blog', [\App\Http\Controllers\PageController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [\App\Http\Controllers\PageController::class, 'showBlog'])->name('blog.show');
Route::get('/clients', [\App\Http\Controllers\PageController::class, 'clients'])->name('clients');
Route::get('/contact', [\App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\PageController::class, 'submitContact'])->middleware('throttle:3,15')->name('contact.submit');

// Subsidiary route
Route::get('/subsidiaries/{slug}', [\App\Http\Controllers\PageController::class, 'showSubsidiary'])->name('subsidiaries.show');

// New static routes
Route::get('/privacy-policy', [\App\Http\Controllers\PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [\App\Http\Controllers\PageController::class, 'terms'])->name('terms');
Route::get('/sitemap', [\App\Http\Controllers\PageController::class, 'sitemap'])->name('sitemap');
Route::get('/search', [\App\Http\Controllers\PageController::class, 'search'])->name('search');

// Localization Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// Temporary route to create admin user on server
Route::get('/create-admin', function () {
    try {
        $role = \App\Models\Role::firstOrCreate(
            ['slug' => 'super-admin'],
            ['name' => 'Super Admin']
        );
        
        $user = \App\Models\User::updateOrCreate(
            ['email' => 'admin@bkjgroup.com'],
            [
                'name' => 'Administrator',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                'role_id' => $role->id,
                'email_verified_at' => now(),
            ]
        );
        
        return "Admin user created/updated successfully! <br>Email: <b>admin@bkjgroup.com</b><br>Password: <b>password123</b>";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin Routes — requires authenticated + verified + admin role
Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Website Content Module
    Route::get('/content', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'index'])->name('content.index');
    Route::post('/content/home', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateHome'])->name('content.updateHome');
    Route::post('/content/about', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateAbout'])->name('content.updateAbout');
    Route::post('/content/gallery', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateGallery'])->name('content.updateGallery');
    Route::post('/content/contact', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateContact'])->name('content.updateContact');
    Route::post('/content/footer', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateFooter'])->name('content.updateFooter');

    // Company Assets (Icon & Favicon)
    Route::get('/company-assets', [\App\Http\Controllers\Admin\CompanyAssetController::class, 'index'])->name('company-assets.index');
    Route::post('/company-assets/global', [\App\Http\Controllers\Admin\CompanyAssetController::class, 'updateGlobal'])->name('company-assets.update-global');
    Route::post('/company-assets/{subsidiary}', [\App\Http\Controllers\Admin\CompanyAssetController::class, 'update'])->name('company-assets.update');

    // News Center
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
    


    // Subsidiaries
    Route::resource('subsidiaries', \App\Http\Controllers\Admin\SubsidiaryController::class);

    // Galleries
    Route::patch('galleries/{gallery}/toggle-status', [\App\Http\Controllers\Admin\GalleryController::class, 'toggleStatus'])->name('galleries.toggle-status');
    Route::patch('galleries/{gallery}/toggle-featured', [\App\Http\Controllers\Admin\GalleryController::class, 'toggleFeatured'])->name('galleries.toggle-featured');
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class);

    // Contacts
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class);

    // Bank Accounts
    Route::resource('bank-accounts', \App\Http\Controllers\Admin\BankAccountController::class);

    // Services, Team Members, Clients
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('team-members', \App\Http\Controllers\Admin\TeamMemberController::class);
    Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class);

    // Users — Super Admin only
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->middleware('admin:super-admin');
});
