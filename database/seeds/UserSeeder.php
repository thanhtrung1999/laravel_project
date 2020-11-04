<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            ['id'=>1, 'email'=>'admin@gmail.com', 'password'=>Hash::make('admin'), 'full_name'=>'Admin', 'address'=>'Thường Tín', 'phone'=>'0968824797', 'level'=>3],
            ['id'=>2, 'email'=>'darkprince411999@gmail.com', 'password'=>Hash::make('trung1999'), 'full_name'=>'Ng Thành Trung', 'address'=>'Hà Đông, Hà Nội', 'phone'=>'0968824797', 'level'=>2],
        ]);
    }
}
