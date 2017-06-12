<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Slide;
class slideController extends Controller
{
    public function getList(){
    	$Slide = Slide::all();

    	return view('admin.slide.list', ['Slide' => $Slide]);
    }

    public function getAdd(){

    	return view('admin.slide.add');
    }

    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'Ten'			=>'required|unique:slide,Ten|min:3|max:200',
    			'Hinh'			=>'required'
    		],
    		[
    			'Ten.required'	=>'Chưa nhập tên',
    			'Ten.unique' 	=>'Tên bị trùng',
    			'Ten.min' 		=>'Nhập tối thiếu 3 ký tự',
    			'Ten.max' 		=>'Nhập tối đa 3 ký tự',
    			'Hinh.required' =>'Không được bỏ trống hình ảnh'
    		]);

    	if($request->hasFile('Hinh')){
    		$file 			= $request->file('Hinh');
    		$extension 		= $file->getClientOriginalExtension();
    		if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
    			return redirect('admin/slide/add')->with('fail', 'Hình không hợp lệ');
    		}
    		$fileName 		= $file->getClientOriginalName();
    		$fileNameRandom	= str_random(5) . "_" . $fileName;

    		$file->move('upload/slide/', $fileNameRandom);
    	}

    	Slide::insert(['Ten' 	=> $request->Ten,
					   'Hinh'	=> $fileNameRandom,
					   'link'	=> changeTitle($request->Ten)]);

    	return redirect('admin/slide/add')->with('success', 'Thêm thành công');
    }

    public function getEdit($id){
    	$Slide = Slide::find($id);
    	return view('admin.slide.edit', ['Slide' => $Slide]);
    }

    public function postEdit(Request $request, $id){
    	$this->validate($request,
    		[
    			'Ten'			=>'required|unique:slide,Ten|min:3|max:200',
    			'Hinh'			=>'required'
    		],
    		[
    			'Ten.required'	=>'Chưa nhập tên',
    			'Ten.unique' 	=>'Tên bị trùng',
    			'Ten.min' 		=>'Nhập tối thiếu 3 ký tự',
    			'Ten.max' 		=>'Nhập tối đa 3 ký tự',
    			'Hinh.required' =>'Không được bỏ trống hình ảnh'
    		]);
    	
    	$Slide 				= Slide::find($id);
    	$Slide->Ten 		= $request->Ten;
    	$Slide->link 		= changeTitle($request->Ten);

    	if($request->hasFile('Hinh')){
    		$file 			= $request->file('Hinh');
    		$extension 		= $file->getClientOriginalExtension();
    		if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
    			return redirect('admin/slide/edit/'.$id)->with('fail', 'Hình không hợp lệ');
    		}
    		$fileName 		= $file->getClientOriginalName();
    		$fileNameRandom	= str_random(5) . "_" . $fileName;

    		$file->move('upload/slide/', $fileNameRandom);
    		unlink('upload/slide/'.$Slide->Hinh);

    		$Slide->Hinh 	= $fileNameRandom;
    	}
    	$Slide->save();
    	
    	return redirect('admin/slide/edit/'.$id)->with('success', 'Sửa thành công');
    }

    public function getDelete($id){
    	$Slide = Slide::find($id);
    	$Slide->delete();

    	return redirect('admin/slide/list')->with('deletedSuccess', 'Xóa thành công');
    }
}
