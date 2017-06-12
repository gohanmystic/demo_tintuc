@extends('layout.index')

@section('content')
<!-- Page Content -->
<div class="container">
	<div class="row">

		<!-- Blog Post Content Column -->
		<div class="col-lg-9">

			<!-- Blog Post -->

			<!-- Title -->
			<h1>{{$TinTuc->TieuDe}}</h1>

			<!-- Author -->
			<p class="lead">
				by <a href="#">Vu</a>
			</p>

			<!-- Preview Image -->
			<img class="img-responsive" src="upload/tintuc/{{$TinTuc->Hinh}}" alt="{{$TinTuc->TieuDe}}">

			<!-- Date/Time -->
			<p><span class="glyphicon glyphicon-time"></span>Đăng ngày {{$TinTuc->created_at}}</p>
			<hr>

			<!-- Post Content -->
			<p class="lead">{!! $TinTuc->TomTat !!}</p>

			<p>{!! $TinTuc->NoiDung!!}</p>

			<hr>

			<!-- Blog Comments -->
			
			@if(isset($user_0))
			<!-- Comments Form -->
				<div class="well">
					<h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
					<form role="form" action="comment/{{$TinTuc->id}}" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="form-group">
							<textarea class="form-control" rows="3" name="comment"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Gửi</button>
					</form>
					<!-- <textarea name="comment" id="comment" class="col-md-12" rows="3"></textarea>
					
					<input type="button" id="send" value="Bình luận"> -->
				</div>
			<hr>
			
			@else
			<?php session_start();
				$_SESSION['idTin'] 		= $TinTuc->id;
				$_SESSION['aliasTin']	= $TinTuc->TieuDeKhongDau;
			?>
				<p class="text-center">Bạn phải <a href="login" style="color:red">Đăng nhập</a> để bình luận</p>
			@endif
			<!-- Posted Comments -->
			@foreach($TinTuc->Comment as $comment)
			
			<div class="media" id="comments">
				<a class="pull-left" href="#">
					<img class="media-object" src="http://placehold.it/64x64" alt="">
				</a>
				<div class="media-body">
					<h4 class="media-heading">{{$comment->User->name}}
						<small>{{$comment->created_at}}</small>
					</h4>
				{{$comment->NoiDung}}
				</div>
			</div>
			@endforeach
		</div>

		<!-- Blog Sidebar Widgets Column -->
		<div class="col-md-3">

			<div class="panel panel-default">
				<div class="panel-heading"><b>Tin liên quan</b></div>
				<div class="panel-body">				
					@foreach($TinLienQuan as $tinlienquan)
					<!-- item -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-5">
							<a href="detail/{{$tinlienquan->id}}/{{$tinlienquan->TieuDeKhongDau}}.html">
								<img class="img-responsive" src="upload/tintuc/{{$tinlienquan->Hinh}}" alt="{{$tinlienquan->TieuDe}}" width="320px">
							</a>
						</div>
						<div class="col-md-7">
							<a href="detail/{{$tinlienquan->id}}/{{$tinlienquan->TieuDeKhongDau}}.html"><b>{{$tinlienquan->TieuDe}}</b></a>
						</div>
						<div class="break"></div>
					</div>
					<!-- end item -->
					@endforeach
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading"><b>Tin nổi bật</b></div>
				<div class="panel-body">
				@foreach($TinNoiBat as $tinnoibat)
					<!-- item -->
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-5">
							<a href="detail/{{$tinnoibat->id}}/{{$tinnoibat->TieuDeKhongDau}}.html">
								<img class="img-responsive" src="upload/tintuc/{{$tinnoibat->Hinh}}" alt="{{$tinnoibat->TieuDe}}" width="320px">
							</a>
						</div>
						<div class="col-md-7">
							<a href="detail/{{$tinnoibat->id}}/{{$tinnoibat->TieuDeKhongDau}}.html"><b>{{$tinnoibat->TieuDe}}</b></a>
						</div>
						<div class="break"></div>
					</div>
					<!-- end item -->
				@endforeach
				</div>
			</div>

		</div>

	</div>
	<!-- /.row -->
</div>
<!-- end Page Content -->
@endsection

@section('script')
<script>
	$(document).ready(function(){
		$("#send").click(function(){
			if($("#comment").val() != ""){
				$.ajax({
					type 	: "get",
					url		: "comment",
					data	: {idTin:<?php echo $TinTuc->id ?>, comment:$("#comment").val()},
					success	: function(data){
						$("#comments").append(data);
					}
				});
			}
		});
	});
</script>
@endsection
