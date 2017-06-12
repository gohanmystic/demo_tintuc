@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể loại
                    <small>{{$TheLoai->Ten}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/theloai/edit/{{$TheLoai->id}}" method="POST">
                     @if(count($errors) > 0)
                        <div class="alert alert-danger">
                             @foreach($errors->all() as $error)
                                 {{$error}} <br>
                             @endforeach
                         </div>
                    @endif

                     @if(session('success'))
                         <div class="alert alert-success">{{session('success')}}</div>
                     @endif
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Tên mới</label>
                        <input class="form-control" name="Ten" placeholder="Tên thể loại"
                        value="{{$TheLoai->Ten}}" />
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