@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>
                    <i class="fa fa-edit"></i> 编辑个人资料
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update',$user->id)}}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                    <input type="hidden" name="_method" value="PUT">
                    {{csrf_field()}}
                    @include('shared._error')
                    <div class="form-group">
                        <label for="name-field">用户名</label>
                        <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name',$user->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="email-field">邮箱</label>
                        <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email',$user->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="introduction-field">个人简介</label>
                        <textarea name="introduction" id="introduction-field" class="form-control" rows="3" >{{ old('introduction',$user->introduction) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="avatar-field">用户头像</label>
                        <input type="file" name="avatar" class="form-control image-upload-input" id="avatar-field">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
