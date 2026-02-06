<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployersTableSeeder extends Seeder
{
    public function run(): void
    {
        $employers = [
            [
                'full_name' => 'Sarah Benmadi',
                'email' => 'sarah.benmadi@techcorp.dz',
                'password' => Hash::make('password123'),
                'company' => 'TechCorp Solutions',
                'city' => 'Algiers',
                'contact_person' => 'Sarah Benmadi',
                'phone' => '0211234567',
                'location' => 'Hydra, Algiers',
                'description' => 'Leading technology solutions company specializing in software development, IT consulting, and digital transformation services.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mohamed Rezki',
                'email' => 'm.rezki@educationfirst.dz',
                'password' => Hash::make('password123'),
                'company' => 'Education First',
                'city' => 'Constantine',
                'contact_person' => 'Mohamed Rezki',
                'phone' => '0319876543',
                'location' => 'Constantine City Center',
                'description' => 'Educational technology company focused on creating innovative learning platforms and digital educational solutions for schools and universities.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Leila Bensalem',
                'email' => 'l.bensalem@mediaplus.dz',
                'password' => Hash::make('password123'),
                'company' => 'MediaPlus Agency',
                'city' => 'Oran',
                'contact_person' => 'Leila Bensalem',
                'phone' => '0412345678',
                'location' => 'Oran City Center',
                'description' => 'Full-service digital marketing agency offering social media management, content creation, and brand development services.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Kamel Chikhi',
                'email' => 'k.chikhi@retailmax.dz',
                'password' => Hash::make('password123'),
                'company' => 'RetailMax',
                'city' => 'Annaba',
                'contact_person' => 'Kamel Chikhi',
                'phone' => '0381234567',
                'location' => 'Annaba Industrial Zone',
                'description' => 'Retail management company providing inventory solutions, point-of-sale systems, and retail consulting services for businesses.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Nadia Belhadj',
                'email' => 'n.belhadj@healthcare.dz',
                'password' => Hash::make('password123'),
                'company' => 'HealthCare Plus',
                'city' => 'Tlemcen',
                'contact_person' => 'Nadia Belhadj',
                'phone' => '0431234567',
                'location' => 'Tlemcen Medical Center',
                'description' => 'Healthcare management company providing medical equipment, hospital management systems, and healthcare consulting services.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Rachid Kaci',
                'email' => 'r.kaci@logisticspro.dz',
                'password' => Hash::make('password123'),
                'company' => 'LogisticsPro',
                'city' => 'Blida',
                'contact_person' => 'Rachid Kaci',
                'phone' => '0251234567',
                'location' => 'Blida Industrial Zone',
                'description' => 'Logistics and supply chain management company offering transportation, warehousing, and distribution services across Algeria.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Amina Djerrad',
                'email' => 'a.djerrad@financehub.dz',
                'password' => Hash::make('password123'),
                'company' => 'FinanceHub',
                'city' => 'Béjaïa',
                'contact_person' => 'Amina Djerrad',
                'phone' => '0341234567',
                'location' => 'Béjaïa Business Center',
                'description' => 'Financial services company providing accounting, bookkeeping, tax consulting, and financial management solutions for businesses.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('employers')->insert($employers);
    }
}
