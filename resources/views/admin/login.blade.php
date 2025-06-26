@extends('admin.layouts.master2')
@section('title', $page_title)

@section('content')
    <img src="{{ asset('public/admin/assets/images/company-logo.png')}}" class="logo-login">


    <div class="d-flex justify-content-center align-items-center login-wrapper">
        <div class="login-form-wrapper">
        <h2 class="welcome">Welcome</h2>
        <p class="sign-text">Sign in with your email</p>
        <form class="login-form" method="POST" action="{{url('admin/authenticate')}}">
             @csrf
            @method('POST')
            @error('credentials')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="row login-field">
                <div class="col-md-12">
                    <label class="label">Email Address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Type here">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row login-field">
                <div class="col-md-12">
                    <label class="label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Type here">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row login-field">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-main btn-full btn-login">Login</button>
                </div>
            </div>
        </form>

    </div>
        
    </div>


@endsection