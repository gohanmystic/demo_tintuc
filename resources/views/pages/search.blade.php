@extends('layout.index')

@section('content')
    <div class="container">
        <div class="row">
            @include('layout.menu')
            <?php
            function highLight($str, $searchKey){
                return str_replace($searchKey, "<span style='color:red'>$searchKey</span>", $str);
            }
            ?>
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>Từ khóa : {{$searchKey}}</b></h4>
                    </div>

                    @foreach($TinTuc as $tintuc)
                    <div class="row-item row">
                        <div class="col-md-3">

                            <a href="detail/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="{{$tintuc->TieuDe}}">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3>{!! highLight($tintuc->TieuDe, $searchKey) !!}</h3>
                            <p>{!! highLight($tintuc->TomTat, $searchKey) !!}</p>
                            <a class="btn btn-primary" href="detail/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html">Xem chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                    @endforeach
                    <!-- Pagination -->
                    <div class="row text-center">
                        <div class="col-lg-12">
                            {!! $TinTuc->appends(['searchKey' =>$searchKey])->links()!!}﻿
                            <!-- {!! $TinTuc->links() !!} -->
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
            </div>          
        </div>
    </div>
@endsection
