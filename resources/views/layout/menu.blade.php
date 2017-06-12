<div class="col-md-3 ">
	<ul class="list-group" id="menu">
		<li href="#" class="list-group-item menu1 active">
			Menu
		</li>
		@foreach($TheLoai as $theloai)
			@if(count($theloai->LoaiTin) > 0)
				<li href="#" class="list-group-item menu1">
					{{$theloai->Ten}}
				</li>
				<ul>
					@foreach($theloai->LoaiTin as $loaitin)
					<li class="list-group-item">
						<a href="category/{{$loaitin->id}}/{{$loaitin->TenKhongDau}}.html">{{$loaitin->Ten}}</a>
					</li>
					@endforeach
				</ul>
			@endif
		@endforeach
	</ul>
</div>