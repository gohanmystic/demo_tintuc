<?php

use Illuminate\Database\Seeder;

class slide extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slide')->insert([
        	['Ten'	=>	'Phan Thị Mơ thử sức với sân khấu kịch', 'Hinh' => 'phan-thi-mo-1-3984-1490342174_490x294.jpg', 'link' => 'phan-thi-mo-thu-suc-voi-san-khau-kich'],
        	['Ten'	=>	'Phạm Hương khoe giọng trong MV đầu tay', 'Hinh' => 'pham-huong-khoe-giong-trong-mv-dau-tay-1491286120_490x294.jpg', 'link' => 'pham-huong-khoe-giong-trong-mv-dau-tay'],
        	['Ten'	=>	'Ngọc Trinh khác lạ với màu tóc mới', 'Hinh' => 'ngoc-trinh-khoe-hinh-anh-khac-la-voi-toc-moi-nhuom-1491274712_490x294.jpg', 'link' => 'ngoc-trinh-khac-la-voi-mau-toc-moi']
        	]);
    }
}
