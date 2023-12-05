<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class CleanTableCommand extends Command
{
    protected $signature = 'clean:table';
    protected $description = 'Clean records added more than a week ago with no entries in the pivot table';

    public function handle()
    {
        $this->info('Cleaning records started...');

        try {
            $weekAgo = Carbon::now()->subWeek();

            Post::where('created_at', '<', $weekAgo)
                ->whereDoesntHave('relatedTable')
                ->delete();

            $this->info('Cleaning records completed successfully.');
        } catch (\Exception $e) {
            Log::error('Error cleaning records: ' . $e->getMessage());
            $this->error('An error occurred while cleaning records. Check the logs for details.');
        }
    }
}
