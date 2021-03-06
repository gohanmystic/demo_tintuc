   
@extends('layout.index')

@section('content')
<!-- Page Content -->
<div class="container">

	@include('layout.slide')
	<div class="row main-left">
		@include('layout.menu')

		<div class="col-md-9">
			<div class="panel panel-default">            
				<div class="panel-heading" style="background-color:#337AB7; color:white;" >
					<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
				</div>

				<div class="panel-body">
				@foreach($TheLoai as $theloai)
					@if(count($theloai->LoaiTin) > 0)
					<!-- item -->
					<div class="row-item row">
						<h3>
							<a href="category.html">{{$theloai->Ten}}</a> |
							@foreach($theloai->LoaiTin as $loaitin)	
							<small><a href="category/{{$loaitin->id}}/{{$loaitin->TenKhongDau}}.html"><i>{{$loaitin->Ten}}</i></a>/</small>
							@endforeach
						</h3>

						<?php 
							$data 	= $theloai->TinTuc->where('NoiBat', 1)->sortByDesc('created_at')->take(5);
							$tintuc1= $data->shift();
						?>
					
						<div class="col-md-8 border-right">
							<div class="col-md-5">
								<a href="detail/{{$tintuc1->id}}/{{$tintuc1->TieuDeKhongDau}}.html">
									<img class="img-responsive" src="upload/tintuc/{{$tintuc1['Hinh']}}" alt="{{$tintuc1->TieuDe}}">
								</a>
							</div>

							<div class="col-md-7">
								<h3>{{$tintuc1['TieuDe']}}</h3>
								<p>{!!$tintuc1['TomTat']!!}</p>
								<a class="btn btn-primary" href="detail/{{$tintuc1->id}}/{{$tintuc1->TieuDeKhongDau}}.html">Xem thêm<span class="glyphicon glyphicon-chevron-right"></span></a>
							</div>

						</div>
						<div class="col-md-4">
						@foreach($data->all() as $tintuc)
							<a href="detail/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html">
								<h4>
									<p><img src="upload/tintuc/{{$tintuc->Hinh}}" width="30px" height="30px">
									{{$tintuc->TieuDe}}</p>
								</h4>
							</a>
						@endforeach
						</div>

						<div class="break"></div>
					</div>
					<!-- end item -->
					@endif
				@endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
</div>
<!-- end Page Content -->
@endsection