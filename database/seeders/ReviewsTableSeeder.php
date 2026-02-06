<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Review;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $reviews = [
            [
                'rating' => 5,
                'review' => 'Excellent web developer! Delivered high-quality work on time and communicated professionally throughout the project.',
                'user_name' => 'Tech Solutions Algeria',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 4,
                'review' => 'Great math tutor! Very patient with students and explains complex concepts clearly. Highly recommended.',
                'user_name' => 'Education Plus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 5,
                'review' => 'Outstanding content writer! Creative, professional, and always meets deadlines. A pleasure to work with.',
                'user_name' => 'Digital Marketing Pro',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 4,
                'review' => 'Reliable and trustworthy babysitter. Kids love her and she always follows instructions perfectly.',
                'user_name' => 'Happy Parent',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 5,
                'review' => 'Exceptional graphic designer! Created amazing logos and marketing materials for our company.',
                'user_name' => 'Freelance Hub',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 4,
                'review' => 'Good communication skills and professional attitude. Delivered quality work on schedule.',
                'user_name' => 'Digital Marketing Pro',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rating' => 5,
                'review' => 'Amazing math tutor! My daughter\'s grades improved significantly within just 2 months.',
                'user_name' => 'Grateful Parent',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
