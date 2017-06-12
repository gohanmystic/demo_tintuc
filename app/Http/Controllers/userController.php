<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use App\TheLoai;
use App\TinTuc;
use App\Comment;
class userController extends Controller
{
	public function getList(){
		$User = User::all();
		return view('admin.user.list', ['User' => $User]);
	}

	public function getAdd(){
		return view('admin.user.add');
	}

	public function postAdd(Request $request){
		$this->validate($request,
			[
				'name'					=>'required|min:3|max:100',
				'email'					=>'required|unique:users,email',
				'password'				=>'required|min:6|max:30',
				'passwordAgain'			=>'required|same:password'
			],
			[
				'name.required'			=>'Tên không được bỏ trống',
				'name.min'				=>'Tên tối thiểu 3 ký tự',
				'name.max'				=>'Tên tối đa 100 ký tự',
				'email.required'		=>'Email không được bỏ trống',
				'email.unique'			=>'Email bị trùng',
				'password.min'			=>'Mật khẩu tối thiểu 6 ký tự',
				'password.max'			=>'Mật khẩu tối đa 30 ký tự',
				'passwordAgain.required'=>'Chưa nhập lại password',
				'passwordAgain.same'	=>'Password nhập lại không đúng'
			]);
		$request->old('name');
		$request->old('email');

		$User = new User;
		$User->name 				= $request->name;
		$User->email 				= $request->email;
		$User->level 				= $request->level;
		$User->password 			= bcrypt($request->password);
		$User->save();

		return redirect('admin/user/add')->with('success', 'Thêm thành công');
	}

	public function getEdit($id){
		$User = User::find($id);

		return view('admin.user.edit', ['User' => $User]);
	}

	public function postEdit(Request $request, $id){
		$this->validate($request,
			[
				'name'				=>'required|min:3|max:100',
				'password'			=>'min:6|max:100',
				'passwordAgain'		=>'same:password'
			],
			[
				'name.required'		=>'Tên không được bỏ trống',
				'name.min'			=>'Tên tối thiểu 3 ký tự',
				'name.max'			=>'Tên tối đa 100 ký tự',
				'password.min'		=>'Mật khẩu tối thiểu 6 ký tự',
				'password.max'		=>'Mật khẩu tối đa 30 ký tự',
				'passwordAgain.same'=>'Password nhập lại không đúng'
			]);
		$User = User::find($id);
		$User->name 				= $request->name;
		$User->level 				= $request->level;
		if($request->changePassword == "on"){
			$this->validate($request,
			[
				'password'			=>'required|min:6|max:100',
				'passwordAgain'		=>'required|same:password'
			],
			[
				'password.required' =>'Chưa nhập mật khẩu',
				'passwordAgain.required'=>'Chưa nhập lại mật khẩu',
				'password.min'		=>'Mật khẩu tối thiểu 6 ký tự',
				'password.max'		=>'Mật khẩu tối đa 30 ký tự',
				'passwordAgain.same'=>'Password nhập lại không đúng'
			]);
			$User->password 			= bcrypt($request->password);
		}		
		$User->save();

		return redirect('admin/user/edit/'.$id)->with('success', "Sửa thành công");
	}

	public function getDelete($id){
		$User = User::find($id);
		$User->delete();

		return redirect('admin/user/list')->with('deletedSuccess', "Xoá thành công");
	}

	public function getComment($id){
		 $User 		= User::find($id);
		 $Comment 	= Comment::where('idUser', '=', $User->id)->get();

		 return view('admin.user.comment', ['User' => $User, 'Comment' => $Comment]);
	}

	public function getLoginAdmin(){
		return view('admin.login');
	}
	public function postLoginAdmin(Request $request){
		$this->validate($request,
			[
				'email'				=>'required|email',
				'password'			=>'required|min:3|max:30'
			],
			[
				'email.required'	=>'Chưa nhập email',
				'email.email'		=>'Email không đúng định dạng',
				'password.required'	=>'Chưa nhập password'
			]);

		if(Auth::attempt(['email' =>$request->email, 'password' =>$request->password])){
		 	return redirect('admin/theloai/list');
		}else{
			$fail = "Đăng nhập không thành công";
			return redirect('admin/login')->with('fail', 'Đăng nhập không thành công!');
		}
	}

	public function getLogout(){
		Auth::logout();
		return redirect('admin/login');
	}
}
