<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = Supplier::all();
        $categories = Category::all();

        if ($suppliers->isEmpty() || $categories->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 200; $i++) {
            Item::factory()->create([
                'supplier_id' => $suppliers->random()->id, 
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}