<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TinTuc;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;
class tintucController extends Controller
{
    public function getList(){
    	$TinTuc = TinTuc::all();
    	return view('admin.tintuc.list', ['TinTuc' => $TinTuc]);
    }

    public function getAdd(){
    	$TheLoai = TheLoai::all();
    	$LoaiTin = LoaiTin::all();
    	return view('admin.tintuc.add', ['TheLoai' => $TheLoai, 'LoaiTin' => $LoaiTin]);
    }

    public function postAdd(Request $request){
    	
    	$this->validate($request,
    		[
    			'LoaiTin'			=> 'required',
    			'TieuDe'			=> 'required|unique:TinTuc,TieuDe',
    			'TomTat'			=> 'required',
    			'NoiDung'			=> 'required'
    		],
    		[	
    			'LoaiTin.required'	=> 'Chưa chọn loại tin',
    			'TieuDe.unique'		=> 'Tiêu đề bị trùng',
    			'TieuDe.required'	=> 'Tiêu đề không được trống',
    			'TomTat.required'	=> 'Tóm tắt không được trống',
    			'NoiDung.required'	=> 'Nội dung không được trống'
    		]);

    	$TinTuc = new TinTuc;
    	$TinTuc->idLoaiTin			= $request->LoaiTin;
    	$TinTuc->TieuDe				= $request->TieuDe;
        $TinTuc->TieuDeKhongDau     = changeTitle($request->TieuDe);
    	$TinTuc->TomTat				= $request->TomTat;
    	$TinTuc->NoiDung			= $request->NoiDung;
    	$TinTuc->NoiBat 			= $request->NoiBat;
        $TinTuc->SoLuotXem          = 0;
    	//kiem tra nhap file
    	if($request->hasFile('Hinh')){
    		$file 					= $request->file('Hinh');
            //kiem tra file co hop le khong
    		$extension 				= $file->getClientOriginalExtension(); // ham tra ve duoi file
    		if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
    			return redirect('admin/tintuc/add')->with('fail', 'Hình không hợp lệ');
    		}
    		$fileName 				= $file->getClientOriginalName(); // ham tra ve ten file
    		$fileNameRandom			= str_random(5) . "_" . $fileName;
    		//kiem tra neu ten file sau khi random van bi trung, thi random tiep
    		while(file_exists('upload/tintuc/'. $fileNameRandom)){
    			$fileNameRandom		= str_random(5) . "_" . $fileName;
    		}
    		//luu file
    		$file->move("upload/tintuc", $fileNameRandom); // ham luu file
    		$TinTuc->Hinh 			= $fileNameRandom;
    	}else{
    		$request->Hinh  		= "";
    	}
    	$TinTuc->save();

    	return redirect('admin/tintuc/add')->with('success', 'Thêm thành công');
    }

    public function getEdit($id){
        $TinTuc                     = TinTuc::find($id);
        $TheLoai                    = TheLoai::all();
        $LoaiTin                    = LoaiTin::all();
        return view('admin.tintuc.edit', ['TinTuc'      => $TinTuc, 
                                          'TheLoai'     => $TheLoai,
                                          'LoaiTin'     => $LoaiTin]);
    }

    public function postEdit(Request $request, $id){
        $this->validate($request,
            [
                'LoaiTin'           => 'required',
                'TieuDe'            => 'required|unique:TinTuc,TieuDe,'.$id,
                'TomTat'            => 'required',
                'NoiDung'           => 'required'
            ],
            [   
                'LoaiTin.required'  => 'Chưa chọn loại tin',
                'TieuDe.required'   => 'Tiêu đề không được trống',
                'TieuDe.unique'     => 'Tiêu đề không được trùng',
                'TomTat.required'   => 'Tóm tắt không được trống',
                'NoiDung.required'  => 'Nội dung không được trống'
            ]);

        $TinTuc                     = TinTuc::find($id);
        $TinTuc->idLoaiTin          = $request->LoaiTin;
        $TinTuc->TieuDe             = $request->TieuDe;
        $TinTuc->TieuDeKhongDau     = changeTitle($request->TieuDe);
        $TinTuc->TomTat             = $request->TomTat;
        $TinTuc->NoiDung            = $request->NoiDung;
        $TinTuc->NoiBat             = $request->NoiBat;

        //kiem tra nhap file
        if($request->hasFile('Hinh')){
            $file                   = $request->file('Hinh');
            //kiem tra file co hop le khong
            $extension              = $file->getClientOriginalExtension(); // ham tra ve duoi file
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
                return redirect('admin/tintuc/add')->with('fail', 'Hình không hợp lệ');
            }
            $fileName               = $file->getClientOriginalName(); // ham tra ve ten file
            $fileNameRandom         = str_random(5) . "_" . $fileName;
            //kiem tra neu ten file sau khi random van bi trung, thi random tiep
            while(file_exists('upload/tintuc/'. $fileNameRandom)){
                $fileNameRandom     = str_random(5) . "_" . $fileName;
            }
            //luu file
            $file->move("upload/tintuc", $fileNameRandom); // ham luu file
            //xoa file cu
            unlink("upload/tintuc/".$TinTuc->Hinh);
            $TinTuc->Hinh           = $fileNameRandom;
        }else{
        }
        $TinTuc->save();

        return redirect('admin/tintuc/edit/'.$id)->with('success', 'Sửa thành công');

    }
    public function getDelete($id){
        $TinTuc = TinTuc::find($id);
        $TinTuc->delete();

        return redirect('admin/tintuc/list')->with('deleteSuccess', 'Xóa thành công');
    }

    public function getComment($id){
        $TinTuc     = TinTuc::find($id);
        $Comment    = Comment::where('idTinTuc', '=', $TinTuc->id)->get();
        
        return view('admin.tintuc.comment', ['Comment' => $Comment, 'TinTuc' => $TinTuc]);
    }
}
