<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('values')->delete();
        DB::table('values')->insert([
            ['id'=>1, 'value'=>'S', 'attribute_id'=>1],
            ['id'=>2, 'value'=>'M', 'attribute_id'=>1],
            ['id'=>3, 'value'=>'L', 'attribute_id'=>1],
            ['id'=>4, 'value'=>'Đỏ', 'attribute_id'=>2],
            ['id'=>5, 'value'=>'Xanh', 'attribute_id'=>2],
            ['id'=>6, 'value'=>'Đen', 'attribute_id'=>2],
        ]);
    }
}
