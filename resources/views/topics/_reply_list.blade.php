<ul class="list-unstyled">
    <hr>
    @foreach($replies as $index=>$reply)
        <li class="media" name="reply{{$reply->id}}" id="reply{{$reply->id}}">
            <div class="media-left">
                <a href="{{route('users.show',[$reply->user_id])}}" title="{{$reply->user->name}}">
                    <img class="media-object img-thumbnail mr-3" src="{{$reply->user->avatar}}"
                         style="width:48px;height:48px;" alt="{{$reply->user->name}}">
                </a>
            </div>
            <div class="media-body">
                <div class="media-heading mt-0 text-secondary">
                    <a href="{{route('users.show',[$reply->user_id])}}" title="{{$reply->user->name}}">
                        {{$topic->user->name}}
                    </a>
                    <span class="text-secondary">·</span>
                    <span class="meta text-secondary"
                          title="{{$reply->created_at}}">{{$reply->created_at->diffForHumans()}}</span>
                    {{--                    回复删除按钮--}}
                    <span class="meta float-right">
                        <form action="{{route('replies.destroy',$reply->id)}}" onsubmit="return confirm('确定删除此评论？');"
                              method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                                   <button title="删除回复" type="submit"
                                           class="btn btn-default btn-xs pull-left text-secondary">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        </form>
                    </span>
                </div>
                <div class="reply-conent text-secondary">
                    {!! $reply->content !!}
                </div>
            </div>
        </li>
        @if(!$loop->last)
            <hr>
        @endif
    @endforeach
</ul>
