<?php

use Illuminate\Database\Seeder;

class comment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('comment')->insert([
    		['NoiDung' => 'Bài viết này được', 'idUser' => '1', 'idTinTuc' => '93', 'created_at' => '2016-06-09 17:20:45' ], 
    		['NoiDung' => 'Hay quá trời', 'idUser' => '2', 'idTinTuc' => '19', 'created_at' => '2016-06-09 17:20:45' ], 
    		['NoiDung' => 'Tôi rất thích bài viết này', 'idUser' => '2', 'idTinTuc' => '22', 'created_at' => '2016-06-09 17:20:45' ], 
    		['NoiDung' => 'Ý kiến của tôi khác so với bài này', 'idUser' => '2', 'idTinTuc' => '41', 'created_at' => '2016-06-09 17:20:45' ], 
    		['NoiDung' => 'Tôi rất thích bài viết này', 'idUser' => '2', 'idTinTuc' => '50', 'created_at' => '2016-06-09 17:20:45' ], 
    		['NoiDung' => 'Bài viết này được', 'idUser' => '1', 'idTinTuc' => '94', 'created_at' => '2016-06-09 17:20:46' ], 
    		['NoiDung' => 'Bài viết này được', 'idUser' => '1', 'idTinTuc' => '99', 'created_at' => '2016-06-09 17:20:46' ], 
    		['NoiDung' => 'Bài viết này được', 'idUser' => '2', 'idTinTuc' => '22', 'created_at' => '2016-06-09 17:20:46' ], 
    		['NoiDung' => 'Tôi chưa có ý kiến gì', 'idUser' => '2', 'idTinTuc' => '48', 'created_at' => '2016-06-09 17:20:46' ], 
    		['NoiDung' => 'Bài viết này chưa được hay lắm', 'idUser' => '1', 'idTinTuc' => '69', 'created_at' => '2016-06-09 17:20:46' ], 
    		['NoiDung' => 'Bài viết này được', 'idUser' => '1', 'idTinTuc' => '87', 'created_at' => '2016-06-09 17:20:46' ]
    		]);
    }
}
