<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\CategoryExpence;
use App\Models\ComboItem;
use App\Models\Customer;
use App\Models\Expence;
use App\Models\Hold;
use App\Models\Option;
use App\Models\Payement;
use App\Models\PayementIncome;
use App\Models\PayementOutcome;
use App\Models\Posale;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Register;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\Table;
use App\Models\User;
use App\Models\Waiter;
use App\Models\Warehouse;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        Category::factory(20)->create();
        CategoryExpence::factory(20)->create(); 
        Customer::factory(20)->create();
        Supplier::factory(20)->create();
        Product::factory(20)->create();
        ComboItem::factory(20)->create();
        Store::factory(20)->create();
        User::factory(20)->create();
        Expence::factory(20)->create();
        Register::factory(20)->create();
        Zone::factory(20)->create();
        Table::factory(20)->create();
        Waiter::factory(20)->create();
        Hold::factory(20)->create();
        Option::factory(20)->create();
        Sale::factory(20)->create();
        PayementIncome::factory(20)->create();
        Warehouse::factory(20)->create();
        Purchase::factory(20)->create();
        PayementOutcome::factory(20)->create();
        Posale::factory(20)->create();
        Stock::factory(20)->create();
        Setting::factory()->create([
             'company_name' => 'Test User',
            'logo' => 'test@example.com',
            'phone' => '0558516808',
            'currency' => 'DA',
            'keyboard' => '1',
            'receiptfooter' => 'Thank you for your business',
            'theme' => 'light',
            'discount' => 0,
            'tax' => 0,
            'timezone' => 'Europe/Paris',
            'language' => 'francais',
            'stripe' => 0,
            'decimals' => 1,
            'time_visit' => now(),
                 ]);
    }
}
