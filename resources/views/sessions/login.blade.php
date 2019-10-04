@extends('layouts.base')
@section('title', '登录')

@section('content')
<div class="offset-md-2 col-md-8">
    <div class="card ">
        <div class="card-header">
            <h5>登录</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">邮箱：</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    {!! $errors->first('email','<div class="alert alert-danger mt-2">
                        :message
                    </div>') !!}
                </div>

                <div class="form-group">
                    <label for="password">密码：</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    {!! $errors->first('password','<div class="alert alert-danger mt-2">
                        :message
                    </div>') !!}
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">记住我</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">登录</button>
            </form>

            <hr>

            <p>还没账号？<a href="{{ route('signup') }}">现在注册！</a></p>
        </div>
    </div>
</div>
@stop
