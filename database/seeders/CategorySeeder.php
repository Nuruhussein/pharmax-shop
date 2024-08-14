<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Painkillers',
            'Antibiotics',
            'Vitamins',
            'Cough & Cold',
            'Allergy Medications'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
