@extends('layouts.app')
@section('title',isset($category) ? $category->name :'话题列表')
@section('content')
<div class="row mb-5">
    <div class="mb-lg-9 col-md-9 topic-list">
        @if(isset($category))
            <div class="alert alert-info" role="alert">
                  {{$category->name}} : {{$category->description}}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-transparent">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{active_class(!if_query('order','recent'))}}" href="{{Request::url()}}">最后回复</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{active_class(if_query('order','recent'))}}" href="{{Request::url()}}?order=recent">最新发布</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                @include('topics._topics_list',['topics'=>$topics])
                {{--分页--}}
                <div class="mt-5">
                    {!! $topics->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="mb-lg-3 mb-md-3">
        @include('topics._sidebar')
    </div>
</div>
@endsection
