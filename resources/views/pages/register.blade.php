@extends('layout.index')

@section('content')
<!-- Page Content -->
<div class="container">
	<!-- slider -->
	<div class="row carousel-holder">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
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
			<div class="panel panel-default">
				<div class="panel-heading">Đăng ký tài khoản</div>
				<div class="panel-body">
					<form action="register" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div>
							<label>Họ tên</label>
							<input type="text" class="form-control" name="name" value="{{old('name')}}">
						</div>
						<br>
						<div>
							<label>Email</label>
							<input type="email" class="form-control" name="email" value="{{old('email')}}">
						</div>
						<br>	
						<div>
							<label>Nhập mật khẩu</label>
							<input type="password" class="form-control" name="password">
						</div>
						<br>
						<div>
							<label>Nhập lại mật khẩu</label>
							<input type="password" class="form-control" name="passwordAgain">
						</div>
						<br>
						<button type="submit" class="btn btn-default">Đăng ký</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-2">
		</div>
	</div>
	<!-- end slide -->
</div>
<!-- end Page Content -->
@endsection