<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'name' => 'Mobile',
                'description' => 'Video and sound quality: Fair, Resolution: 480p',
                'stripe_product_id' => 'prod_TBbFiS6gz28jRv', 
                'stripe_price_id' => 'price_1SFE2kFqwshUV9Bvdk6uVXFq',    
                'price' => 10,
                'currency' => 'INR',
                'billing_interval' => 'daily',
                'streams' => 1,
                'downloads' => 1,
                'quality' => 'Fair',
                'resolution' => '480p',
                'devices' => 'Mobile phone, tablet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Basic',
                'description' => 'Video and sound quality: Good, Resolution: 720p (HD)',
                'stripe_product_id' => 'prod_TBbFPUKbLEkX20',
                'stripe_price_id' => 'price_1SFE3FFqwshUV9BvhvjvtUND',
                'price' => 20,
                'currency' => 'INR',
                'billing_interval' => 'daily',
                'streams' => 1,
                'downloads' => 1,
                'quality' => 'Good',
                'resolution' => '720p',
                'devices' => 'TV, computer, mobile phone, tablet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Standard',
                'description' => 'Video and sound quality: Great, Resolution: 1080p (Full HD)',
                'stripe_product_id' => 'prod_TBbGMAYWVfcIJ1',
                'stripe_price_id' => 'price_1SFE3wFqwshUV9BvlmiQJRtg',
                'price' => 30,
                'currency' => 'INR',
                'billing_interval' => 'daily',
                'streams' => 2,
                'downloads' => 2,
                'quality' => 'Great',
                'resolution' => '1080p',
                'devices' => 'TV, computer, mobile phone, tablet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Premium',
                'description' => 'Video and sound quality: Best, Resolution: 4K + HDR, Spatial audio included',
                'stripe_product_id' => 'prod_TBbGZKJNn5xDQe',
                'stripe_price_id' => 'price_1SFE4NFqwshUV9Bv1Pvued30',
                'price' => 40,
                'currency' => 'INR',
                'billing_interval' => 'daily',
                'streams' => 4,
                'downloads' => 6,
                'quality' => 'Best',
                'resolution' => '4K + HDR',
                'devices' => 'TV, computer, mobile phone, tablet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
