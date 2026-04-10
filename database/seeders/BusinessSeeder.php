<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Category;
use App\Models\Link;
use App\Models\PageView;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        for ($i = 1; $i <= 6; $i++) {
            $userName = "Pemilik Bisnis {$i}";
            $user = User::create([
                'name' => $userName,
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);

            $businessName = "Bisnis Mantap {$i}";
            $category = $categories->random();

            $business = Business::create([
                'user_id' => $user->id,
                'name' => $businessName,
                'slug' => Str::slug($businessName),
                'tagline' => "Tagline untuk {$businessName} yang sangat menarik.",
                'description' => "Deskripsi lengkap untuk {$businessName}. Kami menyediakan layanan terbaik di bidang {$category->name}.",
                'category_id' => $category->id,
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'is_verified' => $i % 2 == 0,
                'is_active' => true,
                'view_count' => rand(100, 1000),
                'click_count' => rand(50, 500),
            ]);

            // Add some links
            Link::create([
                'business_id' => $business->id,
                'title' => 'WhatsApp Kami',
                'url' => 'https://wa.me/628123456789',
                'icon' => 'whatsapp',
                'order' => 1,
            ]);

            Link::create([
                'business_id' => $business->id,
                'title' => 'Kunjungi Website',
                'url' => 'https://example.com',
                'icon' => 'globe',
                'order' => 2,
            ]);

            // Add some page views
            for ($j = 0; $j < 10; $j++) {
                PageView::create([
                    'business_id' => $business->id,
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0',
                    'created_at' => now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }
}
