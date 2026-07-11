<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanupExpiredBlogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup and transition blog statuses based on rules';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = \Carbon\Carbon::now();

        // Find blogs older than 7 days
        $blogsToDelete = \App\Models\Blog::where('created_at', '<=', $now->copy()->subDays(7))->get();
        $count = 0;

        foreach ($blogsToDelete as $blog) {
            // Delete image if exists
            if ($blog->thumbnail) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($blog->thumbnail);
            }
            $blog->delete();
            $count++;
        }

        $this->info("Blog cleanup completed. Deleted: {$count} blogs older than 7 days.");
    }
}
