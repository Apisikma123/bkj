<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap...');

        // Initialize sitemap
        $sitemap = \Spatie\Sitemap\Sitemap::create();
        
        // Add static pages
        $sitemap->add(\Spatie\Sitemap\Tags\Url::create('/')->setPriority(1.0)->setChangeFrequency(\Spatie\Sitemap\Tags\Url::CHANGE_FREQUENCY_DAILY));
        $sitemap->add(\Spatie\Sitemap\Tags\Url::create('/about')->setPriority(0.8)->setChangeFrequency(\Spatie\Sitemap\Tags\Url::CHANGE_FREQUENCY_MONTHLY));
        $sitemap->add(\Spatie\Sitemap\Tags\Url::create('/services')->setPriority(0.9)->setChangeFrequency(\Spatie\Sitemap\Tags\Url::CHANGE_FREQUENCY_WEEKLY));
        $sitemap->add(\Spatie\Sitemap\Tags\Url::create('/subsidiaries')->setPriority(0.8)->setChangeFrequency(\Spatie\Sitemap\Tags\Url::CHANGE_FREQUENCY_MONTHLY));
        $sitemap->add(\Spatie\Sitemap\Tags\Url::create('/gallery')->setPriority(0.7)->setChangeFrequency(\Spatie\Sitemap\Tags\Url::CHANGE_FREQUENCY_WEEKLY));
        $sitemap->add(\Spatie\Sitemap\Tags\Url::create('/blog')->setPriority(0.9)->setChangeFrequency(\Spatie\Sitemap\Tags\Url::CHANGE_FREQUENCY_DAILY));
        $sitemap->add(\Spatie\Sitemap\Tags\Url::create('/contact')->setPriority(0.6)->setChangeFrequency(\Spatie\Sitemap\Tags\Url::CHANGE_FREQUENCY_YEARLY));

        // Note: In a real scenario, you would also loop through active dynamic pages, blogs, and services from the database here.
        // Example: 
        // Blog::where('status', 'published')->get()->each(function (Blog $post) use ($sitemap) {
        //     $sitemap->add(Url::create("/blog/{$post->slug}")->setLastModificationDate($post->updated_at));
        // });

        $path = public_path('sitemap.xml');
        $sitemap->writeToFile($path);

        $this->info('Sitemap generated successfully at ' . $path);
    }
}
