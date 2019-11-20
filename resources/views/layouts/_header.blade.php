<nav class="navbar navbar-expand-lg navbar-light bg-light  navbar-static-top">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">LaraBBS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mr-auto">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{active_class(if_route('topics.index'))}}"><a href="{{route('topics.index')}}" class="nav-link">话题</a></li>
                    <li class="nav-item {{category_nav_active(1)}}"><a href="{{route('categories.show',1)}}" class="nav-link">分享</a></li>
                    <li class="nav-item {{category_nav_active(2)}}"><a href="{{route('categories.show',2)}}" class="nav-link">教程</a></li>
                    <li class="nav-item {{category_nav_active(3)}}"><a href="{{route('categories.show',3)}}" class="nav-link">问答</a></li>
                    <li class="nav-item {{category_nav_active(4)}}"><a href="{{route('categories.show',4)}}" class="nav-link">公告</a></li>
                </ul>
            </ul>
            <ul class="navbar-nav navbar-right">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">登录</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">注册</a>
                </li>
                    @else
                    <li class="nav-item">
                        <a href="{{route('topics.create')}}" class="mt-1 mr-3 font-weight-bold nav-link">
                            <i class="fa fa-plus"></i>
                        </a>
                    </li>
                    <li class="xbav-item notification-badge">
                    <li class="nav-item notification-badge">
                        <a class="nav-link mr-3 badge badge-pill badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'secondary' }} text-white" href="{{ route('notifications.index') }}">
                            {{ Auth::user()->notification_count }}
                        </a>
                    </li>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button"  data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                            <img src=" {{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @can('manage_contents')
                                <a class="dropdown-item" href="{{url(config('administrator.uri'))}}">
                                    <i class="fas fa-tachometer-alt mr-2"></i>
                                    管理后台
                                </a>
                                @endcan
                            <a class="dropdown-item" href="{{route('users.show',Auth::user()->id) }}">
                               <i class="fas fa-user mr-2"></i> 个人中心
                            </a>
                            <a class="dropdown-item" href="{{ route('users.edit',Auth::user()->id) }}">
                                <i class="fas fa-edit mr-2"></i>编辑资料
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" id="logout" class="dropdown-item">
                                <form action="{{route('logout')}}" method="POST" onsubmit="return confirm('您确定要退出吗？')">
                                    {{csrf_field()}}
                                    <button class="btn btn-block btn-danger" type="submit" name="button">退出
                                    </button>
                                </form></a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
