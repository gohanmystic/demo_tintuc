<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\User;
use App\Comment;
class ajaxController extends Controller
{
    public function getLoaiTin($id){
    	$LoaiTin = LoaiTin::where('idTheLoai', '=', $id)->get();

    	foreach ($LoaiTin as $loaitin) {
    		echo "<option value=".$loaitin->id.">".$loaitin->Ten."</option>";
    	}
    }

    public function getTheLoai($id){
        $LoaiTin = LoaiTin::find($id);
        $TheLoai = TheLoai::where('id', '=', $LoaiTin->idTheLoai)->first();

        
        //echo "<option selected value=".$TheLoai->id.">".$TheLoai->Ten."</option>";
    }

    // public function getComment(Request $request){
    //     $TinTuc             = TinTuc::find($request->idTin);
    //     $Comment            = new Comment;
    //     $Comment->idUser    = Auth::user()->id;
    //     $userName           = Auth::user()->name;
    //     $Comment->idTinTuc  = $request->idTin;
    //     $Comment->NoiDung   = $request->comment;
    //     $Comment->save();

    //     echo '<div class="media">
    //             <a class="pull-left" href="#">
    //                 <img class="media-object" src="http://placehold.it/64x64" alt="">
    //             </a>
    //             <div class="media-body">
    //                 <h4 class="media-heading">'.$userName.'
    //                     <small>'.$Comment->created_at.'</small>
    //                 </h4>
    //             '.$Comment->NoiDung.'
    //             </div>
    //         </div>';
    // }
}
