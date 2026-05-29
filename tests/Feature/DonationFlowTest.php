<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Report;
use App\Models\Donation;

class DonationFlowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_submit_donation_and_it_is_saved_and_returns_json_for_ajax()
    {
        $report = Report::factory()->create([
            'goal_amount' => 100000,
            'disaster_status' => 'Terjadi',
        ]);

        $payload = [
            'report_id' => $report->id,
            'donor_name' => 'Test Donor',
            'email' => 'tester@example.com',
            'amount' => 50000,
            'payment_method' => 'Transfer Bank',
        ];

        $response = $this->postJson(route('donasi.store'), $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['success' => true]);

        $this->assertDatabaseHas('donations', [
            'report_id' => $report->id,
            'donor_name' => 'Test Donor',
            'amount' => 50000,
        ]);

        $this->assertEquals(1, Donation::count());
    }
}
