<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 300) as $index) {
            Contact::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->numberBetween(750000003,771100781 ), // Adjust the length as needed
            ]);
        }
    }
}
