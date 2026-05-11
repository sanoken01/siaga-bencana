<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Report;

class CleanDummyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:clean-dummy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all dummy/historical data from database, keep only real BUMN data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧹 Cleaning dummy data from database...');

        // Delete historical dummy data
        $historicalCount = Report::where('source', 'Historical')->delete();
        $this->line("  • Deleted {$historicalCount} historical dummy records");

        // Delete any records that look like test data
        $testCount = Report::where('unique_key', 'like', 'historical_%')->delete();
        $this->line("  • Deleted {$testCount} test records");

        // Keep only verified BUMN data
        $remainingCount = Report::count();

        $this->info('✅ Cleanup complete!');
        $this->line("  • Remaining records: {$remainingCount}");
        $this->line('  • Only BUMN and live API data remains');
    }
}
