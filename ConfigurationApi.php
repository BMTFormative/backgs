------------------------------------
-- Begin of Laravel Migration and API Setup for Product Management

-- Creating a migration for the 'products' table.
php artisan make:migration create_products_table
-- Defining the schema for the 'products' table.
Schema::create('products', function (Blueprint $table) {
    $table->id();  -- Primary key for the products table.
    $table->string('Reference')->unique();  -- Unique product reference code.
    $table->string('Designation');  -- Product name or designation.
    $table->string('Marque')->nullable();  -- Brand of the product, optional.
    $table->decimal('Prix', 8, 2)->default(0)->unsigned();  -- Price of the product, defaulting to 0.
    $table->integer('Quantity')->default(0)->unsigned();  -- Stock quantity of the product, defaulting to 0.
    $table->string('Rayon')->nullable();  -- Store section or aisle, optional.
    $table->timestamps();  -- Timestamps for record creation and last update.
});

-- Generating corresponding model, controller with API resources, and seeder.
php artisan make:model Product
php artisan make:controller ProductController --api
php artisan make:seeder ProductSeeder
-- Seeding the 'products' table with initial data.
php artisan db:seed --class=ProductSeeder

------------------------------------
-- Setup for suppliers is analogous, creating a table and associated elements for supplier management.

-- Creating a migration for the 'suppliers' table.
php artisan make:migration create_suppliers_table --create=suppliers
-- Defining the schema for the 'suppliers' table.
Schema::create('suppliers', function (Blueprint $table) {
    $table->id();  -- Primary key for the suppliers table.
    $table->string('Nom')->nullable();  -- Name of the supplier.
    $table->string('Prorietaire')->nullable();  -- Owner of the supplier company.
    $table->string('Address')->nullable();  -- Supplier's address.
    $table->string('City')->nullable();  -- City where the supplier is located.
    $table->string('Country')->nullable();  -- Country of the supplier.
    $table->string('Phone')->nullable();  -- Contact phone number.
    $table->string('Mobile')->nullable();  -- Mobile phone number.
    $table->string('Fax')->nullable();  -- Fax number.
    $table->string('Email')->nullable();  -- Email address.
    $table->timestamps();  -- Timestamps for record creation and last update.
});

-- Generating corresponding model, controller with API resources, and seeder.
php artisan make:model Supplier
php artisan make:controller SupplierController --api
php artisan make:seeder SupplierSeeder
-- Seeding the 'suppliers' table with initial data.
php artisan db:seed --class=SupplierSeeder

------------------------------------
-- Similar setup for customers.

-- Creating a migration for the 'customers' table.
php artisan make:migration create_customers_table --create=customers
-- Defining the schema for the 'customers' table.
Schema::create('customers', function (Blueprint $table) {
    $table->id();  -- Primary key for the customers table.
    $table->string('Nom')->nullable();  -- Customer's name.
    $table->string('Prorietaire')->nullable();  -- Owner of the customer account.
    $table->string('Address')->nullable();  -- Customer's address.
    $table->string('City')->nullable();  -- City of the customer.
    $table->string('Country')->nullable();  -- Country of the customer.
    $table->string('Phone')->nullable();  -- Contact phone number.
    $table->string('Mobile')->nullable();  -- Mobile phone number.
    $table->string('Fax')->nullable();  -- Fax number.
    $table->string('Email')->nullable();  -- Email address.
    $table->timestamps();  -- Timestamps for record creation and last update.
});

-- Generating corresponding model, controller with API resources, and seeder.
php artisan make:model Customer
php artisan make:controller CustomerController --api
php artisan make:seeder CustomerSeeder
-- Seeding the 'customers' table with initial data.
php artisan db:seed --class=CustomerSeeder

------------------------------------
-- Setup for the 'sales' table in the Laravel application.

-- Creating a migration for the 'sales' table.
php artisan make:migration create_sales_table --create=sales
-- Defining the schema for the 'sales' table.
Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('SaleNumber');
            $table->dateTime('DateSale');
            $table->string('OrderType');
            $table->bigInteger('CustomerId')->unsigned(); // Change to bigInteger, unsigned            
            $table->bigInteger('TaxId')->unsigned();  // bigint without foreign key constraint
            $table->decimal('TotalAmount ', 10, 2);
            $table->decimal('TotalTax', 10, 2);
            $table->decimal('TotalDiscount', 10, 2);
            $table->decimal('TotalAmountWith', 10, 2)->nullable();
            $table->timestamps();
        });
-- Generating corresponding model, controller with API resources, and seeder for sales.
php artisan make:model Sale
php artisan make:controller SaleController --api
php artisan make:seeder SaleSeeder
-- Seeding the 'sales' table with initial data.
php artworkisan db:seed --class=SaleSeeder
------------------------------------
-- Setup for the 'sales' table in the Laravel application.

-- Creating a migration for the 'saledetails' table.
php artisan make:migration create_saledetails_table --create=saledetails
-- Defining the schema for the 'saledetails' table.
Schema::create('saledetails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('SaleId')->unsigned();  // bigint without foreign key constraint
            $table->bigInteger('ProductId')->unsigned();  // bigint without foreign key constraint
            $table->bigInteger('TaxId')->unsigned();  // bigint without foreign key constraint
            $table->integer('Qty');
            $table->decimal('UnitPrice', 10, 2);
            $table->decimal('PrixVente', 10, 2); // Before tax
            $table->decimal('Discount', 10, 2); //  Calculated from Discount 
            $table->decimal('TaxAmount', 10, 2); //  Calculated from TaxRate in the Tax Table
            $table->decimal('Montant', 10, 2); // Sum of TotalPrice and (TaxAmount Or Discount )          
            $table->timestamps();
        });

-- Generating corresponding model, controller with API resources, and seeder for sales.
php artisan make:model SaleDetail
php artisan make:controller SaleDetailController --api
php artisan make:seeder SaleDetailSeeder
-- Seeding the 'SaleDetails' table with initial data.
php artworkisan db:seed --class=SaleDetailSeeder
------------------------------------
-- Setup for the 'stocks' table, managing inventory entries.

-- Creating a migration for the 'stocks' table.
php artisan make:migration create_stocks_table --create=stocks
-- Defining the schema for the 'stocks' table.
Schema::create('stocks', function (Blueprint $table) {
    $table->id();  -- Primary key for the stocks table.
    $table->string('ArrivalNumber');  -- Identifier for the stock arrival.
    $table->dateTime('DateArrival');  -- Date and time of the stock arrival.
    $table->bigInteger('SupplierId')->unsigned();  -- Reference to the supplier, unsigned for foreign key relation.
    $table->bigInteger('ProductId')->unsigned();  -- Reference to the product, unsigned for foreign key relation.
    $table->integer('Qty');  -- Quantity received in this stock.
    $table->decimal('PrixAchat', 10, 2);  -- Purchase price of the product.
    $table->decimal('PrixGros', 10, 2);  -- Wholesale price of the product.
    $table->decimal('PrixDetail', 10, 2);  -- Retail price of the product.
    $table->timestamps();  -- Timestamps for record creation and last update.
});

-- Generating corresponding model, controller with API resources, and seeder for stocks.
php artisan make:model Stock
php artisan make:controller StockController --api
php artisan make:seeder StockSeeder
-- Seeding the 'stocks' table with initial data.
php artisan db:seed --class=StockSeeder

------------------------------------
-- Setup for the 'paycustomers' table, managing customer payments.

-- Creating a migration for the 'paycustomers' table.
php artisan make:migration create_paycustomers_table --create=paycustomers
-- Defining the schema for the 'paycustomers' table.
Schema::create('paycustomers', function (Blueprint $table) {
    $table->id();  -- Primary key for the paycustomers table.
    $table->string('SaleNumber');  -- Reference to the sale associated with the payment.
    $table->bigInteger('CustomerId')->unsigned();  // bigint without foreign key constraint
    $table->dateTime('DatePayment');  -- Date and time of the payment.
    $table->bigInteger('GlobalepaymentId')->unsigned();  -- Reference to a global payment identifier, unsigned.
    $table->decimal('Amount', 10, 2);  -- Amount of the payment.
    $table->timestamps();  -- Timestamps for record creation and last update.
});

-- Generating corresponding model, controller with API resources, and seeder for paycustomers.
php artisan make:model Paycustomer
php artisan make:controller PaycustomerController --api
php artisan make:seeder PaycustomerSeeder
-- Seeding the 'paycustomers' table with initial data.
php artisan db:seed --class=PaycustomerSeeder
------------------------------------
-- Setup for the 'globalpayments' table, managing aggregated or large-scale payments.

-- Creating a migration for the 'globalpayments' table.
php artisan make:migration create_globalpayments_table --create=globalpayments
-- Defining the schema for the 'globalpayments' table.
Schema::create('globalpayments', function (Blueprint $table) {
    $table->id();  -- Primary key for the globalpayments table.
    $table->dateTime('DatePayment');  -- Date and time the payment was made.
    $table->decimal('Amount', 10, 2);  -- Total amount of the payment.
    $table->bigInteger('CustomerId')->unsigned();  -- Reference to the customer making the payment, unsigned for foreign key relation.
    $table->timestamps();  -- Timestamps for record creation and last update.
});

-- Generating corresponding model, controller with API resources, and seeder for global payments.
php artisan make:model Globalpayment
php artisan make:controller GlobalpaymentTontroller --api
php artisan make:seeder GlobalpaymentSeeder
-- Seeding the 'globalpayments' table with initial data.
php artisan db:seed --class=GlobalpaymentSeeder

------------------------------------
------------------------------------
-- Setup for the 'taxes' table, managing aggregated or large-scale taxes.

-- Creating a migration for the 'taxes' table.
php artisan make:migration create_taxes_table --create=taxes
-- Defining the schema for the 'taxes' table.
Schema::create('taxes', function (Blueprint $table) {
            $table->id();  // Primary key for the taxes table
            $table->string('TaxName');  // Name of the tax (e.g., VAT, GST)
            $table->decimal('TaxRate', 5, 2);  // Tax rate as a percentage
            $table->date('EffectiveDate');  // Start date from which the tax rate is applicable
            $table->date('EndDate')->nullable();  // End date until which the tax rate is applicable
            $table->text('Description')->nullable();  // Additional information about the tax
            $table->boolean('Status')->default(true); // Status of the tax, default is true
            $table->timestamps();  // Timestamps for record creation and last update
        });

-- Generating corresponding model, controller with API resources, and seeder for global payments.
php artisan make:model Taxe
php artisan make:controller TaxeController --api
php artisan make:seeder TaxeSeeder
-- Seeding the 'Taxe' table with initial data.
php artisan db:seed --class=TaxeSeeder

------------------------------------
-- Setup for models and controllers to handle views that calculate total payments and amounts.

-- Creating a model and controller for handling 'totalpayment' view calculations.
php artisan make:model totalpayment
php artisan make:controller TotalpaymentController --api
-- This setup is intended for managing data access and API endpoints that relate to the total payments calculated across transactions.

-- Creating a model and controller for handling 'totalamount' view calculations.
php artisan make:model totalamount
php on make:controller TotalamountController --api
-- These are similar to 'totalpayment' but focus on the total amounts from sales or transactions.

------------------------------------
-- Additional setup for model and controller related to product quantity changes and global sales and buys statistics.

-- Creating a model for 'ProductQtyChange', handling the changes in product quantities due to sales or restocking.
php artisan make:model ProductQtyChange 
-- This model will likely interact with views or database queries to provide real-time information on inventory levels.

-- Creating a model and controller for 'Globalsellbuys', aggregating total sales and payments per customer.
php artisan make:model globalsellbuy
php artisan make:controller GlobalsellbuyController --api
-- This setup is crucial for understanding the financial interactions per customer, providing a clear view of total sales versus payments.

-- End of Laravel Migration and API Setup
