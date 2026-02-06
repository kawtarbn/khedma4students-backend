<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CompleteCRUDTestingSeeder::class,
            ComprehensiveStudentsSeeder::class,
            ComprehensiveEmployersSeeder::class,
            ComprehensiveJobsSeeder::class,
            ComprehensiveServicesSeeder::class,
            ComprehensiveApplicationsSeeder::class,
            ComprehensiveNotificationsSeeder::class,
            SuccessStoriesTableSeeder::class,
        ]);
    }
}
