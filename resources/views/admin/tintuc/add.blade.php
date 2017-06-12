@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Thêm</small>
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
                <form action="admin/tintuc/add" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="TheLoai" id="TheLoai">
                            <option value="">Chọn thể loại</option>
                            @foreach($TheLoai as $theloai)
                                <option value="{{$theloai->id}}" id="TheLoai">{{$theloai->Ten}}</option>
                            @endforeach   
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại tin</label>
                        <select class="form-control" name="LoaiTin" id="dataLoaiTin">         
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề</label> <span id="errorTieuDe" style="color: red"></span>
                        <input class="form-control" name="TieuDe" placeholder="Tiêu đề" id="TieuDe" />
                    </div>
                    
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea name="TomTat" id="demo" class ="form-control ckeditor" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="NoiDung" id="demo" class ="form-control ckeditor" rows="5"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" name="Hinh" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nổi bật</label>
                        <input type="radio" name="NoiBat" value="1" checked="">Có
                        <input type="radio" name="NoiBat" value="0" checked="">Không
                    </div>

                    <button type="submit" class="btn btn-default">Thêm</button>
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
        $("#TheLoai").change(function(){
            var theloai = $('#TheLoai').val();
            $.get("admin/ajax/loaitin/"+theloai, {TheLoai: theloai}, function(data){
                 $("#dataLoaiTin").html(data);
            });
        });

        // $("#TieuDe").keyup(function(){
        //     var tieude = $("#TieuDe").val();
        //     $.get("admin/ajax/tintuc/"+tieude, {TieuDe: tieude}, function(data){
        //          $("#errorTieuDe").html(data);
        //     });
        // });
    });
</script>
@endsection