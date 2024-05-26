<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            [
                'Nom' => 'anonymous',
                'Prorietaire' => 'anonymous',
                'Address' => 'anonymous',
                'City' => 'anonymous',
                'Country' => 'anonymous',
                'Phone' => '',
                'Mobile' => '',
                'Fax' => '',
                'Email' => '',
                'created_at' => Carbon::parse('2023-07-15T09:00:00Z'),
                'updated_at' => Carbon::parse('2023-07-22T16:00:00Z')
            ],
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
                'Country' => 'Algeria',
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
                'Country' => 'Algeria',
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
                'Country' => 'Algeria',
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
                'Country' => 'Algeria',
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
                'Country' => 'Algeria',
                'Phone' => '555-6078',
                'Mobile' => '555-6078',
                'Fax' => '555-6079',
                'Email' => 'hello@fashionfront.com',
                'created_at' => Carbon::parse('2023-05-21T12:00:00Z'),
                'updated_at' => Carbon::parse('2023-05-28T10:10:00Z')
            ],
            // Continue adding all other customers in a similar format
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
