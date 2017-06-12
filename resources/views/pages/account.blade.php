@extends('layout.index')

@section('content')
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Thông tin tài khoản</div>
				<div class="panel-body">
					<form action="account/{{$user_0->id}}" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div>
							<label>Họ tên</label>
							<input type="text" class="form-control" name="name" value="{{$User->name}}">
						</div>
						<br>
						<div>
							<label>Email</label>
							<input type="email" class="form-control" name="email" disabled value="{{$User->email}}">
						</div>
						<br>	
						<div>
							<input type="checkbox" class="" name="changePassword" id="changePassword">
							<label>Đổi mật khẩu</label>
							<input type="password" class="form-control password" name="password" >
						</div>
						<br>
						<div>
							<label>Nhập lại mật khẩu</label>
							<input type="password" class="form-control password" name="passwordAgain">
						</div>
						<br>
						<input type="submit" class="btn btn-default" value="Sửa">

					</form>
				</div>
			</div>
		</div>
		<div class="col-md-2">
		</div>
	</div>
	<!-- end slide -->
</div>
@endsection

@section('script')
<script>
	$(document).ready(function(){
		$(".password").attr("disabled", "true");
		var ckbox = $("#changePassword");
		$(ckbox).click(function(){
			if(ckbox.is(":checked")){
				$(".password").removeAttr("disabled");
			}else{
				$(".password").attr("disabled", "true");
			}
		});
	});
</script>
@endsection