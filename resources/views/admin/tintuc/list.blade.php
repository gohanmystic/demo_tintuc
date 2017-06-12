@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            @if(session('deleteSuccess'))
                <div class="alert alert-success">{{session('deleteSuccess')}}</div>
            @endif
                <h1 class="page-header">Tin tức
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Tóm tắt</th>
                        <th>Loại tin</th>
                        <th>Thể loại</th>
                        <th>Số lượt xem</th>
                        <th>Nổi bật</th>
                        <th>Bình luận</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($TinTuc as $tintuc)
                    <tr class="odd gradeX" align="center">
                        <td>{{$tintuc->id}}</td>
                        <td>{{$tintuc->TieuDe}}
                        <p><img src="upload/tintuc/{{$tintuc->Hinh}}" width="100px" alt="{{$tintuc->TieuDe}}"></p>
                        </td>
                        <td>{{$tintuc->TomTat}}</td>
                        <td>{{$tintuc->LoaiTin->Ten}}</td>
                        <td>{{$tintuc->LoaiTin->TheLoai->Ten}}</td>
                        <td>{{$tintuc->SoLuotXem}}</td>
                        <td>
                        @if($tintuc->NoiBat == 1)
                            {{"Có"}}
                        @else {{"Không"}}
                        @endif
                        </td>
                        <td class="center"><i class="fa fa-comments fa-fw"></i><a href="admin/tintuc/comment/{{$tintuc->id}}">Xem</a></td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/tintuc/delete/{{$tintuc->id}}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/edit/{{$tintuc->id}}">Edit</a></td>
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection