<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::whereHas('role', fn ($query) => $query->where('name', 'admin'))->first();

        if (! $admin) {
            $this->command->warn('No admin user found - skipping ProductSeeder');
            return;
        }

        $categoryIds = Category::pluck('id', 'slug');

        $products = [
            // Men Shoes
            ['men-shoes', 'Nike Air Max 90', 'nike-air-max-90', 'NK-AM90-001', 'Classic sneaker with visible air cushioning.', 129.99, 25, true],
             ['men-shoes', 'Adidas Ultraboost 22', 'adidas-ultraboost-22', 'AD-UB22-002', 'Responsive boost midsole built for long runs.', 179.50, 14, true],
            ['men-shoes', 'Leather Oxford Shoe', 'leather-oxford-shoe', 'MN-OXF-003', 'Full-grain leather oxford for formal occasions.', 89.00, 8, true],

            // Women Shoes
            ['women-shoes', 'Nike Air Force 1 Low', 'nike-air-force-1-low', 'NK-AF1-004', 'All-white low-top sneaker that goes with everything.', 110.00, 30, true],
            ['women-shoes', 'Block Heel Sandal', 'block-heel-sandal', 'WM-BHS-005', 'Comfortable 6cm block heel in soft suede.', 64.90, 12, true],
            ['women-shoes', 'Ballet Flat', 'ballet-flat', 'WM-BLF-006', 'Lightweight everyday flat with cushioned insole.', 45.00, 0, false],

            // T-Shirts
            ['t-shirts', 'Basic Cotton Tee', 'basic-cotton-tee', 'TS-BCT-007', '100% combed cotton crew neck, pre-shrunk.', 15.99, 120, true],
            ['t-shirts', 'Oversized Graphic Tee', 'oversized-graphic-tee', 'TS-OGT-008', 'Relaxed fit tee with screen-printed front graphic.', 24.50,60, true],
            ['t-shirts', 'Pique Polo Shirt', 'pique-polo-shirt', 'TS-PPS-009', 'Breathable pique knit polo with ribbed collar.', 32.00, 40, true],

            // Bags
            ['bags', 'Canvas Backpack 20L', 'canvas-backpack-20l', 'BG-CBP-010', 'Water-resistant canvas daypack with laptop sleeve.', 55.00, 18, true],
            ['bags', 'Leather Tote Bag', 'leather-tote-bag', 'BG-LTB-011', 'Roomy tote in vegetable-tanned leather.', 145.00, 6, true],
            ['bags', 'Cabin Trolley 40L', 'cabin-trolley-40l', 'BG-CTR-012', 'Hard-shell carry-on with spinner wheels.', 189.99, 4, true],

            // Accessories
            ['accessories', 'Classic Baseball Cap', 'classic-baseball-cap', 'AC-CBC-013', 'Adjustable six-panel cotton twill cap.', 19.99, 75, true],
            ['accessories', 'Bifold Leather Wallet', 'bifold-leather-wallet', 'AC-BLW-014', 'Slim bifold with six card slots and note pocket.', 39.00, 22, true],
            ['accessories', 'Cotton Crew Socks 3-Pack', 'cotton-crew-socks-3-pack', 'AC-CCS-015', 'Breathable crew socks with reinforced heel and toe.', 12.50, 90, true],
        ];

        foreach ($products as [$categorySlug, $name, $slug, $sku, $description, $price, $stock, $isActive]) {
            if (! isset($categoryIds[$categorySlug])) {
                continue;
            }

            $admin->products()->updateOrCreate(
                ['slug' => $slug],
                [
                   'category_id' => $categoryIds[$categorySlug],
                   'name' => $name,
                   'sku' => $sku,
                   'description' => $description,
                   'price' => $price,
                   'stock' => $stock,
                   'is_active' => $isActive 
                ]
            );
        }
    }
}
