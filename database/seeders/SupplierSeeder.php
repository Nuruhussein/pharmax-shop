<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            ['name' => 'PharmaCo', 'contact_number' => '1234567890', 'email' => 'contact@pharmaco.com', 'address' => '123 Pharma Street'],
            ['name' => 'MediSupply', 'contact_number' => '0987654321', 'email' => 'info@medisupply.com', 'address' => '456 Medi Avenue'],
            ['name' => 'HealthPlus', 'contact_number' => '1122334455', 'email' => 'support@healthplus.com', 'address' => '789 Health Blvd']
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
