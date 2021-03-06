@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
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
            @if(session('fail'))
                <div class="alert alert-danger">{{session('fail')}}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif

                <form action="admin/slide/add" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="Ten" placeholder="Tiêu đề slide" />
                    </div>

                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="Hinh"/>
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