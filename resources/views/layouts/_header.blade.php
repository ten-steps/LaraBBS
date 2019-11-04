<nav class="navbar navbar-expand-lg navbar-light bg-light  navbar-static-top">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">LaraBBS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mr-auto">

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
                    <li class="nav-item dropdown">
                        <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button"  data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                            <img src=" {{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
