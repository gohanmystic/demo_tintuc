<?php

use Illuminate\Database\Seeder;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Trần Quốc Vũ', 'email' => 'vutran@gmail.com', 'level' => '2', 'password' => bcrypt('123456')], 
            ['name' => 'Nguyễn Văn Nam', 'email' => 'namnguyen@gmail.com', 'level' => '1', 'password' => bcrypt('123456')], 
            ['name' => 'Trần Đình Lực', 'email' => 'dinhluc@gmail.com', 'level' => '0', 'password' => bcrypt('123456')]
            ]);
    }
}
