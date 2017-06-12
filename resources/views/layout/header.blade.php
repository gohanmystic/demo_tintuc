<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home">Laravel Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="">Liên hệ</a>
                    </li>
                </ul>

                <form class="navbar-form navbar-left" role="search" action="search" method="get">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Search" name="searchKey">
			        </div>
			        <button type="submit" class="btn btn-default">Tìm kiếm</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                    @if(!isset($user_0))
                        <li><a href="register">Đăng ký</a></li>
                        <li><a href="login">Đăng nhập</a></li>
                    
                    @else
                        @if($user_0->level == 1 || $user_0->level == 2)
                            <li><a href="admin/home"><span class="glyphicon glyphicon-cog"></span>Trang admin</a></li>
                        @endif
                        <li><a href="account/{{$user_0->id}}"><span class ="glyphicon glyphicon-user"></span>{{$user_0->name}}</a></li>
                        <li><a href="logout">Đăng xuất</a></li>
                    @endif
                </ul>
            </div>
    <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>