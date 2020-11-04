<?php

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
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
            AttributeSeeder::class,
            ValueSeeder::class,
            ProductValueSeeder::class,
            VariantSeeder::class,
            VariantValueSeeder::class,
        ]);
    }
}
