<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DisasterDataService;

class FetchDisasterData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disaster:fetch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch disaster data from BMKG and PetaBencana APIs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting disaster data fetch from multiple sources...');

        $beforeCount = \App\Models\Report::count();

        $service = new DisasterDataService();
        $service->fetchAllData();

        $afterCount = \App\Models\Report::count();
        $newRecords = $afterCount - $beforeCount;

        $this->info('✅ All disaster data fetched successfully from:');
        $this->line('  • BMKG (autogempa, gempadirasakan, gempadirect, gempaterkini)');
        $this->line('  • PetaBencana.id (flood reports)');
        $this->line('  • USGS (global earthquakes, filtered for Indonesia)');
        $this->line('  • GDACS (global disaster alerts)');
        $this->line('  • Panto Air (Jakarta flood monitoring)');
        $this->line('  • Historical Data (past disasters)');

        $this->info("📊 Database status:");
        $this->line("  • Total records: {$afterCount}");
        $this->line("  • New records added: {$newRecords}");

        // Show breakdown by source
        $sources = \App\Models\Report::select('source')->selectRaw('COUNT(*) as count')->groupBy('source')->get();
        $this->info("📋 Records by source:");
        foreach ($sources as $source) {
            $this->line("  • {$source->source}: {$source->count} records");
        }

        // Show breakdown by disaster type
        $types = \App\Models\Report::select('disaster_type')->selectRaw('COUNT(*) as count')->groupBy('disaster_type')->get();
        $this->info("🏷️  Records by disaster type:");
        foreach ($types as $type) {
            $this->line("  • {$type->disaster_type}: {$type->count} records");
        }
    }
}
