<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\TheLoai;
use App\Slide;
use App\TinTuc;
use App\LoaiTin;
use App\Comment;
use App\User;
class pagesController extends Controller
{
	public function __construct()
	{
		$TheLoai 	= TheLoai::all();
		$Slide		= Slide::all();
		view()->share('TheLoai'	, $TheLoai);
		view()->share('Slide'	, $Slide);

		if(Auth::check()){
			view()->share('user_0', Auth::user());
		}
	}
    public function gethome(){

    	return view('pages.home');
    }

    public function getContact(){
    	return view('pages.contact');
    }

    public function getCategory($id){
    	$LoaiTin 	= LoaiTin::find($id);
    	$TinTuc 	= TinTuc::where('idLoaiTin', $id)->paginate(5);
    	return view('pages.category', ['LoaiTin' => $LoaiTin, 'TinTuc' => $TinTuc]);
    }
    public function getDetail($id){
    	$TinTuc 	= TinTuc::find($id);
    	$TinLienQuan= TinTuc::where('idLoaiTin', $TinTuc->idLoaiTin)->take(4)->get();
    	$TinNoiBat	= TinTuc::where('NoiBat', 1)->orderBy('created_at', 'desc')->take(4)->get();
    	return view('pages.detail', ['TinTuc' 		=> $TinTuc,
    								 'TinLienQuan' 	=> $TinLienQuan,
    								 'TinNoiBat' 	=> $TinNoiBat]);
    }

    public function getLogin(){
    	return view('pages.login');
    }

    public function postLogin(Request $request){
    	$this->validate($request,
    		[
    			'email'				=>'required|email',
    			'password'			=>'required',
    		],
    		[
    			'email.required'	=>'Chưa nhập email',
    			'email.email'		=>'Email không đúng định dạng',
    			'password.required'	=>'Chưa nhập password'
    		]);

        $request->old('email');

    	if(Auth::attempt(['email'	=> $request->email, 'password' => $request->password])){
    		session_start();
    		if(isset($_SESSION["idTin"]) && isset($_SESSION["aliasTin"])){
    			return redirect('detail/'.$_SESSION["idTin"].'/'.$_SESSION["aliasTin"].'.html');
    		}
    		else{
    			return redirect('home');
    		}
    		
    	}else{
    		return redirect('login')->with('fail', 'Email hoặc mật khẩu sai');
    	}
    }
    public function getLogout(Request $request){
    	session_start();
    	session_unset();
    	session_destroy();
    	Auth::logout();
    	return redirect('home');
    }

    public function getAccount($id)
    {
        $User = User::find($id);

        return view('pages.account', ['User'    => $User]);
    }
    public function postAccount(Request $request, $id){
        
        $this->validate($request,
            [
                'name'          =>'required|min:3|max:30'
            ],
            [
                'name.required' =>'Tên không được để trống',
                'name.min'      =>'Tên phải tối thiểu 3 ký tự',
                'name.max'      =>'Tên tối đa 100 ký tự'
            ]);
        $User            = User::find($id);
        $User->name      = $request->name;

        if($request->changePassword     == "on"){
            $this->validate($request,
                [
                    'password'      =>'required|min:3|max:30',
                    'passwordAgain' =>'required|same:password'
                ],
                [
                    'password.required' =>'Password không được để trống',
                    'password.min'      =>'Password phải tối thiểu 3 ký tự',
                    'password.max'      =>'Password tối đa 100 ký tự',
                    'passwordAgain.required' =>'Password không được để trống',
                    'passwordAgain.same'=>'Password nhập lại sai'
                ]);
            $User->password = bcrypt($request->password);
        }
        $User->save();

        return redirect('account/'.$id);
    }

    public function getRegister(){
        return view('pages.register');
    }
    public function postRegister(Request $request){
        $this->validate($request,
            [
                'name'          =>'required|min:3|max:100',
                'email'         =>'required|unique:users,email',
                'password'      =>'required|min:6|max:30',
                'passwordAgain' =>'required|same:password'
            ],
            [
                'name.required'         =>'Tên không được để trống',
                'email.required'        =>'Email không được để trống',
                'email.unique'          =>'Email đã tồn tại',
                'password.required'     =>'Mật khẩu không được để trống',
                'password.min'          =>'Mật khẩu tổi thiểu 6 ký tự',
                'password.max'          =>'Mật khẩu tối đa 30 ký tự',
                'passwordAgain.required'=>'Chưa nhập lại mật khẩu',
                'passwordAgain.same'    =>'Mật khẩu nhập lại không đúng'
            ]);

        $request->old('name');
        $request->old('email');

        User::insert(['name'    =>$request->name,
                      'email'   =>$request->email,
                      'password'=>bcrypt($request->password)]);

        return redirect('register')->with('success', 'Đăng ký thành công!');
    }

    public function getSearch(Request $request){
        $searchKey = $request->searchKey;

        $TinTuc = TinTuc::where('TieuDe', 'like', "%$searchKey%")
                        ->orWhere('TomTat', 'like', "%$searchKey%")
                        ->orWhere('NoiDung', 'like', "%$searchKey%")
                        ->paginate(5);

        return view('pages.search', ['TinTuc'   => $TinTuc, 'searchKey'     => $searchKey]);
    }

    // public function getArray(){
    //     $tintuc = LoaiTin::all();

    //     foreach ($tintuc as $tt) {
    //         echo "['Ten' => '$tt->Ten', 'TenKhongDau' => '$tt->TenKhongDau', 'idTheLoai' => '$tt->idTheLoai'" . " ], <br>" ;
    //     }
    // }
}
