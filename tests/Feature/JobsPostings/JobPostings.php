<?php

use App\Models\JobPosting;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// test('Job postings can be listed', function () {
//     //list jobs
//     $job = JobPosting::factory()->create();
//     JobPosting::factory()->count(3)->create();

//     $response = $this->actingAs($job)
//                      ->get('/job_listings');

//     $response->assertOk();
//     // Assert that we get exactly 3 postings in our JSON response
//     $response->assertJsonCount(3);
// });

test('Job posting can be created', function () {

    $data = [
        'title'       => 'Senior Developer',
        'description' => 'Join our dynamic team to build the future of tech.',
        'company'     => 'Tech Corp',
        'location'    => 'Remote',
        'salary'      => 1000000,
        'category'    => 'IT',
    ];

    $response = $this->actingAs($job)
                     ->post('/job_listings', $data);

    $response->assertStatus(201);
    $this->assertDatabaseHas('job_postings', [
        'title' => 'Senior Developer',
        'company' => 'Tech Corp'
    ]);
});

