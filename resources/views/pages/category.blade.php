@extends('layout.index')
@section('title', ' | Category')
@section('content')
    <div class="container">
        <div class="row">
            @include('layout.menu')
            
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{$LoaiTin->Ten}}</b></h4>
                    </div>
                    @foreach($TinTuc as $tintuc)
                    <div class="row-item row">
                        <div class="col-md-3">
                        @if($tintuc->TieuDeKhongDau != "")
                            <a href="detail/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html">
                        @else
                            <a href="detail/{{$tintuc->id}}/none.html">
                        @endif 
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="{{$tintuc->TieuDe}}">
                            </a>

                        </div>

                        <div class="col-md-9">
                            <h3>{{$tintuc->TieuDe}}</h3>
                            <p>{!!$tintuc->TomTat!!}</p>
                            @if($tintuc->TieuDeKhongDau != "")
                            <a class="btn btn-primary" href="detail/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html">Xem chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                            @else
                            <a class="btn btn-primary" href="detail/{{$tintuc->id}}/none.html">Xem chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                            @endif
                        </div>
                        <div class="break"></div>
                    </div>
                    @endforeach
                    <!-- Pagination -->
                    <div class="row text-center">
                        <div class="col-lg-12">
                            {!! $TinTuc->links() !!}
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
            </div>          
        </div>
    </div>
@endsection
