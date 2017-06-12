@extends('layout.index')

@section('content')
<div class="container">
	<div class="row carousel-holder">
		<div class="col-md-4"></div>
		<div class="col-md-4">
		@if(count($errors) >0)
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
					{{$error}} <br>
				@endforeach
			</div>
		@endif
		@if(session('fail'))
			<div class="alert alert-danger">{{session('fail')}}</div>
		@endif
			<div class="panel panel-default">
				<div class="panel-heading">Đăng nhập</div>
				<div class="panel-body">
					<form action="login" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div>
							<label>Email</label>
							<input type="email" class="form-control" name="email" value="{{old('email')}}">
						</div>
						<br>	
						<div>
							<label>Mật khẩu</label>
							<input type="password" class="form-control" name="password">
						</div>
						<br>
						<button type="submit" class="btn btn-default">Đăng nhập</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>
@endsection