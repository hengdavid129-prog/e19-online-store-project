<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::whereHas('role', fn ($query) => $query->where('name', 'admin'))->first();

        if (!$admin) {
            $this->command->warn('No admin user found - skipping CategorySeeder.');
            return;
        }

        $categories = [
            [
                'name' => 'Men Shoes',
                'slug' => 'men-shoes',
                'description' => 'Sneaker, runners and formal shoes for men.',
                'is_active' => true,
            ],
            [
                'name' => 'Women Shoes',
                'slug' => 'women-shoes',
                'description' => 'Heels, flats and sneakers for women.',
                'is_active' => true,
            ],
            [
                'name' => 'T-Shirts',
                'slug' => 't-shirts',
                'description' => 'Everyday cotton tees and polo shirts.',
                'is_active' => true,
            ],
            [
                'name' => 'Bag',
                'slug' => 'bags',
                'description' => 'Backpacks, tote bags and travel luggage.',
                'is_active' => true,
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Caps, belts, wallets and socks.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            $admin->categories()->updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
