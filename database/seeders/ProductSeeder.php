<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                "Reference" => "P0001",
                "Designation" => "Water Pump Assembly Volkswagen VW Audi Alltrack Arteon Atlas Beetle Jetta Passat Golf A4 A5 A6 Q3 Q5 Q7 TTS TT 1.8T 2.0T 2012-2021 Replaces 06L121011B 06L121111H",
                "Marque" => "Volkswagen",
                "Prix" => 1500,
                "Quantity" => 16,
                "Rayon" => "A5"
            ],
            [
                "Reference" => "P0002",
                "Designation" => "Car Radiator Hose Compatible With Audi For Q5 Q7 A4 S4 A5 S5 Auto Parts 06L121081K",
                "Marque" => "Volkswagen",
                "Prix" => 1300,
                "Quantity" => 13,
                "Rayon" => null
            ],
            [
                "Reference" => "P0003",
                "Designation" => "WVE by NTK 1T1132 Engine",
                "Marque" => "Volkswagen",
                "Prix" => 1000,
                "Quantity" => 5,
                "Rayon" => null
            ],
            [
                "Reference" => "P0004",
                "Designation" => "86L121081K sdvsxvxcvxcv",
                "Marque" => "Volkswagen",
                "Prix" => 8000,
                "Quantity" => 8,
                "Rayon" => null
            ],
            [
                "Reference" => "P0005",
                "Designation" => "Audi For Q5 Q7 A4 S4 A5 S5 Auto Parts 06L165481K",
                "Marque" => "Volkswagen",
                "Prix" => 13000,
                "Quantity" => 10,
                "Rayon" => null
            ],
            [
                "Reference" => "P0006",
                "Designation" => "Audi For Q5 Q7 A4 S4 A5 S5 Auto Parts 06L16654K",
                "Marque" => "Volkswagen",
                "Prix" => 25000,
                "Quantity" => 4,
                "Rayon" => null
            ],
            [
                "Reference" => "06L121111H",
                "Designation" => "Water Pump Thermostat Housing Assembly 06L121111H Compatible with Audi A1/S1, A3/S3, A4, A5, A6, A7, Q3, Q5, Q7, TT & VW Jetta, Golf, GTI, Beetle, Passat, SportWagen, Arteon, Atlas, Tiguan",
                "Marque" => null,
                "Prix" => 1700,
                "Quantity" => null,
                "Rayon" => null
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
