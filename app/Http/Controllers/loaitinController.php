<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LoaiTin;
use App\TheLoai;
class loaitinController extends Controller
{
    public function getList(){
    	$LoaiTin = LoaiTin::all();
    	return view('admin.loaitin.list', ['LoaiTin' => $LoaiTin]);
    }

    public function getAdd(){
    	$TheLoai = TheLoai::all();
    	return view('admin.loaitin.add', ['TheLoai' => $TheLoai]);
    }

    public function postAdd(Request $request){

    	$this->validate($request,
    		[
    			'TenTheLoai'			=>'required',
    			'TenLoaiTin'			=>'required|unique:LoaiTin,Ten|min:3|max:100'
    		],
    		[
    			'TenTheLoai.required'	=>'Chưa chọn thể loại',
    			'TenLoaiTin.required'	=>'Chưa nhập loại tin',
    			'TenLoaiTin.unique'		=>'Loại tin bị trùng',
    			'TenLoaiTin.min'		=> 'Nhập tối thiểu 3 ký tự',
    			'TenLoaiTin.max'		=> 'Nhập tối đa 100 ký tự'
    		]);
    	//$idTheLoai = TheLoai::select('id')->where('Ten', '=', '$request->TenTheLoai');
    	LoaiTin::insert(['idTheLoai'	=> $request->TenTheLoai,
    					 'Ten'			=> $request->TenLoaiTin,
    					 'TenKhongDau'	=> changeTitle($request->TenLoaiTin)]);

    	return redirect('admin/loaitin/add')->with('success', 'Thêm thành công');
    }

    public function getEdit($id){
    	$LoaiTin = LoaiTin::find($id);
    	$TheLoai = TheLoai::all();
    	return view('admin.loaitin.edit',['LoaiTin' => $LoaiTin,
    									  'TheLoai'	=> $TheLoai]);
    }

    public function postEdit($id, Request $request){
    	$this->validate($request,
    		[
    			'TenTheLoai'			=>'required',
    			'TenLoaiTin'			=>'required|unique:LoaiTin,Ten|min:3|max:100'
    		],
    		[
    			'TenTheLoai.required'	=>'Chưa chọn thể loại',
    			'TenLoaiTin.required'	=>'Chưa nhập loại tin',
    			'TenLoaiTin.unique'		=>'Loại tin bị trùng',
    			'TenLoaiTin.min'		=> 'Nhập tối thiểu 3 ký tự',
    			'TenLoaiTin.max'		=> 'Nhập tối đa 100 ký tự'
    		]);

    	LoaiTin::where('id', '=', $id)
    			->update(['idTheLoai'	=>$request->TenTheLoai,
    					  'Ten'			=>$request->TenLoaiTin,
    					  'TenKhongDau'	=>changeTitle($request->TenLoaiTin)]);

    	return redirect('admin/loaitin/edit/'.$id)->with('success', 'Sửa thành công');
    }

    public function getDelete($id){
    	$LoaiTin 	= LoaiTin::find($id);
    	$TenLoaiTin = $LoaiTin->Ten;
    	$LoaiTin->delete();

    	return redirect('admin/loaitin/list')->with('deleteSuccess', 'Xóa thành công <strong>'.$TenLoaiTin.'</strong>');

    }
}
