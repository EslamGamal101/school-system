@extends('theme.auth.master')
@section('title','Forget Password')
@section('content')
<div class="wrapper vh-100">
    <div class="row align-items-center h-100">
        <form method="POST" action="{{ route('password.email') }}" class="col-lg-3 col-md-4 col-10 mx-auto text-center">
            @csrf
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15" />
                    </g>
                </svg>
            </a>
            <h1 class="h6 mb-3">Forget Password</h1>

            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="email" value="{{old('email')}}" required autofocus autocomplete="username" id="inputEmail" class="form-control form-control-lg" placeholder="Email address">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <button class="btn btn-lg btn-primary btn-block mt-4" type="submit"> {{ __('Email Password Reset Link') }}</button>
        </form>
    </div>
</div>
@endsection