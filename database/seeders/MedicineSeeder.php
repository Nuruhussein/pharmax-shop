<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;
use App\Models\Category;
use App\Models\Supplier;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::pluck('id', 'name');
        $suppliers = Supplier::pluck('id', 'name');

        $medicines = [
            ['name' => 'Aspirin', 'category_id' => $categories['Painkillers'], 'supplier_id' => $suppliers['PharmaCo'], 'quantity' => 100, 'expiry_date' => '2025-12-31'],
            ['name' => 'Amoxicillin', 'category_id' => $categories['Antibiotics'], 'supplier_id' => $suppliers['MediSupply'], 'quantity' => 50, 'expiry_date' => '2024-11-30'],
            ['name' => 'Vitamin C', 'category_id' => $categories['Vitamins'], 'supplier_id' => $suppliers['HealthPlus'], 'quantity' => 200, 'expiry_date' => '2024-08-31'],
            ['name' => 'Cough Syrup', 'category_id' => $categories['Cough & Cold'], 'supplier_id' => $suppliers['PharmaCo'], 'quantity' => 75, 'expiry_date' => '2025-01-15'],
            ['name' => 'Allergy Tablets', 'category_id' => $categories['Allergy Medications'], 'supplier_id' => $suppliers['MediSupply'], 'quantity' => 150, 'expiry_date' => '2024-09-30']
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}
