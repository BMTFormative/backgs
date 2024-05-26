<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            [
                'Nom' => 'EcoWellness',
                'Prorietaire' => 'James Peterson',
                'Address' => '45 Green Lane',
                'City' => 'San Francisco',
                'Country' => 'Algeria',
                'Phone' => '555-1023',
                'Mobile' => '555-1023',
                'Fax' => '555-1024',
                'Email' => 'info@ecowellness.com',
                'created_at' => Carbon::parse('2023-10-15T09:00:00Z'),
                'updated_at' => Carbon::parse('2023-10-22T16:00:00Z')
            ],
            [
                'Nom' => 'TechGadgets',
                'Prorietaire' => 'Laura Chen',
                'Address' => '88 Innovation Drive',
                'City' => 'Austin',
                'Country' => 'USA',
                'Phone' => '555-2034',
                'Mobile' => '555-2034',
                'Fax' => '555-2035',
                'Email' => 'Prorietaire@techgadgets.com',
                'created_at' => Carbon::parse('2023-09-05T14:30:00Z'),
                'updated_at' => Carbon::parse('2023-09-12T11:00:00Z')
            ],
            [
                'Nom' => 'GourmetFoods',
                'Prorietaire' => 'Antonio Ruiz',
                'Address' => '12 Delicacy Avenue',
                'City' => 'New York',
                'Country' => 'USA',
                'Phone' => '555-3045',
                'Mobile' => '555-3045',
                'Fax' => '555-3046',
                'Email' => 'support@gourmetfoods.com',
                'created_at' => Carbon::parse('2023-08-20T10:00:00Z'),
                'updated_at' => Carbon::parse('2023-08-27T19:00:00Z')
            ],
            [
                'Nom' => 'AutoPartsPro',
                'Prorietaire' => 'Mike Johnson',
                'Address' => '67 Mechanic St.',
                'City' => 'Detroit',
                'Country' => 'USA',
                'Phone' => '555-4056',
                'Mobile' => '555-4056',
                'Fax' => '555-4057',
                'Email' => 'sales@autopartspro.com',
                'created_at' => Carbon::parse('2023-07-11T13:20:00Z'),
                'updated_at' => Carbon::parse('2023-07-18T08:30:00Z')
            ],
            [
                'Nom' => 'BookWorld',
                'Prorietaire' => 'Emma White',
                'Address' => '32 Literature Lane',
                'City' => 'Seattle',
                'Country' => 'USA',
                'Phone' => '555-5067',
                'Mobile' => '555-5067',
                'Fax' => '555-5068',
                'Email' => 'inquiries@bookworld.com',
                'created_at' => Carbon::parse('2023-06-01T17:45:00Z'),
                'updated_at' => Carbon::parse('2023-06-08T09:00:00Z')
            ],
            [
                'Nom' => 'FashionFront',
                'Prorietaire' => 'Sophia Taylor',
                'Address' => '90 Vogue Street',
                'City' => 'Miami',
                'Country' => 'USA',
                'Phone' => '555-6078',
                'Mobile' => '555-6078',
                'Fax' => '555-6079',
                'Email' => 'hello@fashionfront.com',
                'created_at' => Carbon::parse('2023-05-21T12:00:00Z'),
                'updated_at' => Carbon::parse('2023-05-28T10:10:00Z')
            ],
            [
                'Nom' => 'HouseHoldGoods',
                'Prorietaire' => 'David Wilson',
                'Address' => '55 Home Comfort Rd.',
                'City' => 'Chicago',
                'Country' => 'USA',
                'Phone' => '555-7089',
                'Mobile' => '555-7089',
                'Fax' => '555-7090',
                'Email' => 'Prorietaire@householdgoods.com',
                'created_at' => Carbon::parse('2023-04-30T15:00:00Z'),
                'updated_at' => Carbon::parse('2023-05-07T20:20:00Z')
            ],
            [
                'Nom' => 'KidsFun',
                'Prorietaire' => 'Rachel Adams',
                'Address' => '22 Playtime Plaza',
                'City' => 'Orlando',
                'Country' => 'USA',
                'Phone' => '555-8090',
                'Mobile' => '555-8090',
                'Fax' => '555-8091',
                'Email' => 'info@kidsfun.com',
                'created_at' => Carbon::parse('2023-03-15T18:30:00Z'),
                'updated_at' => Carbon::parse('2023-03-22T14:40:00Z')
            ],
            [
                'Nom' => 'GardenEssentials',
                'Prorietaire' => 'Henry Clarke',
                'Address' => '78 Green Thumb Rd.',
                'City' => 'Portland',
                'Country' => 'USA',
                'Phone' => '555-9012',
                'Mobile' => '555-9012',
                'Fax' => '555-9013',
                'Email' => 'support@gardenessentials.com',
                'created_at' => Carbon::parse('2023-02-10T11:00:00Z'),
                'updated_at' => Carbon::parse('2023-02-17T12:50:00Z')
            ],
            [
                'Nom' => 'PetCare',
                'Prorietaire' => 'Alice Martinez',
                'Address' => '33 Animal Ave',
                'City' => 'Denver',
                'Country' => 'USA',
                'Phone' => '555-0112',
                'Mobile' => '555-0112',
                'Fax' => '555-0113',
                'Email' => 'hello@petcare.com',
                'created_at' => Carbon::parse('2023-01-20T20:20:00Z'),
                'updated_at' => Carbon::parse('2023-01-27T08:30:00Z')
            ],
            // Make sure to handle empty fields appropriately
            [
                'Nom' => '',
                'Prorietaire' => '',
                'Address' => '',
                'City' => '',
                'Country' => '',
                'Phone' => '',
                'Mobile' => '',
                'Fax' => '',
                'Email' => '',
                'created_at' => null,
                'updated_at' => null
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
