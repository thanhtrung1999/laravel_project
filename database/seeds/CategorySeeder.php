<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Nam', 'parent' => 0],
            ['id' => 2, 'name' => 'Áo nam', 'parent' => 1],
            ['id'=>3, 'name'=>'Quần nam', 'parent'=>1],
            ['id' => 4, 'name' => 'Áo phông', 'parent' => 2],
            ['id'=> 5, 'name'=>'Nữ', 'parent'=>0],
            ['id' => 6, 'name' => 'Áo nữ', 'parent' => 6],
            ['id' => 7, 'name' => 'Quần nữ', 'parent' => 6],
        ]);
    }
}
