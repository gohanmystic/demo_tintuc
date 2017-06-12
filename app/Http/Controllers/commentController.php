<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Comment;
use App\TinTuc;
class commentController extends Controller
{
    public function getCommentTinTuc($id){
    	
    	$Comment 	= Comment::find($id);
    	$idTinTuc 	= $Comment->idTinTuc;
    	$Comment->delete();

    	return redirect('admin/tintuc/comment/'.$idTinTuc)->with('deleteSuccess', 'Xóa thành công');
    }
    public function getCommentUser($id){
    	$Comment 	= Comment::find($id);
    	$idUser 	= $Comment->idUser;
    	$Comment->delete();

    	return redirect('admin/user/comment/'.$idUser)->with('deleteSuccess', 'Xóa thành công');
    }

    public function postComment(Request $request, $id){
        $TinTuc = TinTuc::find($id);
        $Comment = new Comment;
        $Comment->idUser = Auth::user()->id;
        $Comment->idTinTuc = $id;
        $Comment->NoiDung = $request->comment;
        $Comment->save();

        return redirect('detail/'.$id.'/'.$TinTuc->TieuDeKhongDau.'.html');
    }
}

