@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>{{$TinTuc->TieuDe}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12" style="padding-bottom:120px">
                 @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}} <br>
                        @endforeach
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                 @endif
                 @if(session('fail'))
                    <div class="alert alert-danger">
                        {{session('fail')}}
                    </div>
                 @endif
                <form action="admin/tintuc/edit/{{$TinTuc->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="TheLoai" id="dataTheLoai">
                            <option value="">Chọn thể loại</option>
                            @foreach($TheLoai as $theloai)
                                <option 
                                @if($TinTuc->LoaiTin->TheLoai->id == $theloai->id)
                                    {{"selected"}}
                                @endif    
                                value="{{$theloai->id}}" id="TheLoai">{{$theloai->Ten}}</option>
                            @endforeach   
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại tin</label>
                        <select class="form-control" name="LoaiTin" id="dataLoaiTin" >
                            @foreach($LoaiTin as $loaitin)
                                <option 
                                @if($TinTuc->idLoaiTin == $loaitin->id)
                                    {{"selected"}}
                                @endif    
                                value="{{$loaitin->id}}" id="LoaiTin">{{$loaitin->Ten}}</option>
                            @endforeach   
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề</label> <span id="errorTieuDe" style="color: red"></span>
                        <input class="form-control" name="TieuDe" placeholder="Tiêu đề" id="TieuDe" value="{{$TinTuc->TieuDe}}" />
                    </div>
                    
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea name="TomTat" id="demo" class ="form-control ckeditor" rows="3">{{$TinTuc->TomTat}}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="NoiDung" id="demo" class ="form-control ckeditor" rows="5">{{$TinTuc->NoiDung}}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <p><img width="300" src="upload/tintuc/{{$TinTuc->Hinh}}" alt=""></p>
                        <input type="file" name="Hinh" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nổi bật</label>
                        <input 
                        @if($TinTuc->NoiBat == 1)
                            {{"checked"}}
                        @endif
                        type="radio" name="NoiBat" value="1">Có
                        <input 
                        @if($TinTuc->NoiBat == 0)
                            {{"checked"}}
                        @endif
                        type="radio" name="NoiBat" value="0">Không
                    </div>

                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#dataTheLoai").change(function(){
            var theloai = $('#dataTheLoai').val();
            $.get("admin/ajax/loaitin/"+theloai, {TheLoai: theloai}, function(data){
                 $("#dataLoaiTin").html(data);
            });
        });

        // $("#dataLoaiTin").change(function(){
        //     var loaitin = $("#dataLoaiTin").val();
        //     $.get("admin/ajax/theloai/"+loaitin, {LoaiTin: loaitin}, function(data){
        //         if()
        //         $("#dataTheLoai").html(data);
        //     });
        // });
    });
</script>
@endsection