<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;

class theloaiController extends Controller
{
    public function getIndex(){
        return view('admin.index');
    }
	public function getList(){
    	$TheLoai = TheLoai::all();
    	return view('admin.theloai.list', ['TheLoai' => $TheLoai]);
    }

    public function getAdd(){

    	return view('admin.theloai.add');
    }

    public function postAdd(Request $request){
    	$this->validate($request, 
    		[
    			'Ten'			=> 'required|unique:TheLoai,Ten|min:3|max:100'
    		], 
    		[
    			'Ten.required'	=> 'Chưa nhập tên thể loại',
    			'Ten.unique'	=> 'Tên bị trùng',
    			'Ten.min'		=> 'Nhập tối thiểu 3 ký tự',
    			'Ten.max'		=> 'Nhập tối đa 100 ký tự'
    		]);

    	TheLoai::insert(['Ten' 			=> $request->Ten,
    					 'TenKhongDau'	=> changeTitle($request->Ten)]);
    	
    	/*
		$theloai 				= new TheLoai;
		$theloai->Ten 			= $request->Ten;
		$theloai->TenKhongDau	= changeTitle($request->Ten);
		$theloai->save();
    	*/

    	return redirect('admin/theloai/add')->with('success', 'Thêm thành công!');
    }
    public function getEdit($id){
    	$TheLoai = TheLoai::find($id);
    	return view('admin.theloai.edit', ['TheLoai' => $TheLoai]);
    }

    public function postEdit($id, Request $request){
    	$this->validate($request, 
    		[
    			'Ten'			=> 'required|unique:TheLoai,Ten|min:3|max:100'
    		], 
    		[
    			'Ten.required'	=> 'Chưa nhập tên thể loại',
    			'Ten.unique'	=> 'Tên bị trùng',
    			'Ten.min'		=> 'Nhập tối thiểu 3 ký tự',
    			'Ten.max'		=> 'Nhập tối đa 100 ký tự'
    		]);

    	TheLoai::where('id', '=', $id)
    			->update(['Ten' 		=> $request->Ten,
    					  'TenKhongDau'=> changeTitle($request->Ten)]);

    	return redirect('admin/theloai/edit/'. $id)->with('success', 'Sửa thành công');
    }

    public function getDelete($id){
    	/*TheLoai::where('id', '=', $id)
    			->delete();*/
    	$TheLoai 	= TheLoai::find($id);
    	$Ten 		= $TheLoai->Ten;	
    	$TheLoai->delete();
    	return redirect('admin/theloai/list')->with('deleteSuccess', 'Xóa thành công <strong>'.$Ten.'</strong>');
    }
}
