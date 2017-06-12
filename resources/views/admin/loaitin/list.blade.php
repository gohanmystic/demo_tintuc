@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if(session('deleteSuccess'))
                    <div class="alert alert-success">{!!session('deleteSuccess')!!}</div>
                @endif
                <h1 class="page-header">Loại tin
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Tên không dấu</th>
                        <th>Thể loại</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($LoaiTin as $loaitin)
                    <tr class="odd gradeX" align="center">
                        <td>{{$loaitin->id}}</td>
                        <td>{{$loaitin->Ten}}</td>
                        <td>{{$loaitin->TenKhongDau}}</td>
                        <td>{{$loaitin->TheLoai->Ten}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/loaitin/delete/{{$loaitin->id}}">Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaitin/edit/{{$loaitin->id}}">Edit</a></td>
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