<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuccessStoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing success stories first
        DB::table('success_stories')->delete();
        
        // Reset auto-increment
        DB::statement('ALTER TABLE success_stories AUTO_INCREMENT = 1');

        $successStories = [
            [
                'name' => 'Amina Benali',
                'role' => 'Student',
                'rating' => 4.8,
                'story' => 'I found my dream internship through Khedma4Students! The platform connected me with a tech company that was looking for exactly my skills. I gained valuable experience and was offered a full-time position after the internship.',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karim Tlemçani',
                'role' => 'Employer',
                'rating' => 4.9,
                'story' => 'As a startup founder, I needed talented developers quickly. Khedma4Students helped me find amazing students who brought fresh ideas and energy to our team. We hired 3 students and they exceeded all our expectations!',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fatima Zohra',
                'role' => 'Student',
                'rating' => 4.7,
                'story' => 'The platform helped me find freelance web design projects while studying. I earned enough to pay for my tuition and built an impressive portfolio. Now I have multiple clients and a steady income stream.',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mohamed Chérif',
                'role' => 'Student',
                'rating' => 5.0,
                'story' => 'I was struggling to find tutoring opportunities until I discovered Khedma4Students. Within a week, I had 3 students and was earning good money teaching mathematics. The platform changed my student life completely!',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sofia Benzid',
                'role' => 'Student',
                'rating' => 4.6,
                'story' => 'Being an international student, finding part-time work was challenging. Khedma4Students connected me with local businesses that needed my language skills. I now work as a translator and love the flexibility!',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yacine Amrani',
                'role' => 'Employer',
                'rating' => 4.8,
                'story' => 'Our marketing agency needed creative talent for a campaign. We found an incredible graphic design student through Khedma4Students who delivered exceptional work. We now have a long-term partnership!',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lina Mansouri',
                'role' => 'Student',
                'rating' => 4.9,
                'story' => 'I landed my first professional writing gig through Khedma4Students! The platform helped me build my confidence and portfolio. Now I\'m a content creator for multiple companies.',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Omar Khaled',
                'role' => 'Student',
                'rating' => 4.5,
                'story' => 'As a computer science student, I needed practical experience. Khedma4Students helped me find an amazing internship where I worked on real projects. This experience was crucial for my career start!',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nadia Belkacem',
                'role' => 'Employer',
                'rating' => 5.0,
                'story' => 'We run a small e-commerce business and needed customer service support. The students we found through Khedma4Students were professional, reliable, and helped us grow our customer satisfaction ratings significantly.',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rachid Hamid',
                'role' => 'Student',
                'rating' => 4.7,
                'story' => 'Photography is my passion, but finding clients was difficult. Khedma4Students helped me connect with event organizers and businesses. I now have a steady stream of photography gigs!',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Meriem Fares',
                'role' => 'Student',
                'rating' => 4.8,
                'story' => 'I found my dream job as a social media manager through Khedma4Students! The platform made it easy to showcase my skills and connect with companies that valued my creativity.',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bachir Zoubir',
                'role' => 'Employer',
                'rating' => 4.6,
                'story' => 'Our restaurant needed delivery drivers during peak hours. Khedma4Students helped us find reliable students who became an essential part of our team. Great platform for flexible staffing!',
                'badge' => 'success',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('success_stories')->insert($successStories);
    }
}
