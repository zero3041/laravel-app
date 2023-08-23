@extends('layouts.app')

@section('content')

<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="images/image1.png" width="100%" alt="">
            </div>
            <div class="col-2">
                <div class="form-container">
                    @if(count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="form-btn">
                        <span onclick="login()">Login</span>
                        <span onclick="register()">Register</span>
                        <hr id="Indicator">
                    </div>

                    <form id="LoginForm" action="/login" method="post">
                        @csrf
                        <input type="text" placeholder="Username" name="email">
                        <input type="password" placeholder="Password" name="password">
                        <button type="submit" class="btn">Login</button>
                        <a href="">Forgot password</a>
                    </form>

                    <form id=RegForm action="/register" method="post">
                        @csrf
                        <input type="text" placeholder="Name" name="name">
                        <input type="email" placeholder="Email" name="email">
                        <input type="password" placeholder="Password" name="password">
                        <input type="password" placeholder="Re-enter Password" name="repassword">

                        <button type="submit" class="btn">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
