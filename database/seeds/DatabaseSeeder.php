<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(slide::class);
        $this->call(user::class);
        $this->call(theloai::class);
        $this->call(loaitin::class);
        $this->call(tintuc::class);
        $this->call(comment::class);
    }
}
