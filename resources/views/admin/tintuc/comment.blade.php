@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            @if(session('deleteSuccess'))
                <div class="alert alert-success">{{session('deleteSuccess')}}</div>
            @endif
                <h1 class="page-header">Comments
                    <small>{{$TinTuc->TieuDe}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($Comment as $comment)
                    <tr class="odd gradeX" align="center">
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->User->name}}</td>
                        <td>{{$comment->NoiDung}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/del-on-tintuc/{{$comment->id}}"> Delete</a></td>
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