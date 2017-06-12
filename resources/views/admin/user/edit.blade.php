@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
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
                <h1 class="page-header">Sửa
                    <small>{{$User->name}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/user/edit/{{$User->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Tên</label>
                        <input class="form-control" name="name" value="{{$User->name}}"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{$User->email}}" disabled="true" />
                    </div>
                    
                    <div class="form-group">
                        <label>Đổi mật khẩu</label>
                        <input type="checkbox" name="changePassword" id="changePassword">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" class="form-control password" name="password"/>
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input type="password" class="form-control password"  name="passwordAgain" />
                    </div>

                    <div class="form-group">
                        <label>Quyền người dùng</label>
                        <input type="radio" name="level" value="0" @if($User->level == 0){{"checked"}}@endif>Thành viên
                        <input type="radio" name="level" value="1" @if($User->level == 1){{"checked"}}@endif>Quản trị viên
                        <input type="radio" name="level" value="2" @if($User->level == 2){{"checked"}}@endif>Admin
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
            $(".password").attr('disabled', 'true');
            var ckbox =  $("#changePassword");
            $(ckbox).on('click', function(){
                if(ckbox.is(':checked')){
                    $(".password").removeAttr('disabled');                  
                }else{
                    $(".password").attr('disabled','true');
                }
            });
        });
    </script>
@endsection