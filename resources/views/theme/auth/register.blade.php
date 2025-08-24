@extends('theme.auth.master')
@section('title','Register')
@section('content')
<div class="wrapper vh-100">
    <div class="row align-items-center h-100">
        <form method="POST" action="{{ route('register') }}" class="col-lg-6 col-md-8 col-10 mx-auto">
            @csrf
            <div class="mx-auto text-center my-4">
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                    <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                        <g>
                            <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                            <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                            <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                        </g>
                    </svg>
                </a>
                <h2 class="my-3">Register</h2>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="firstname">Full Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="inputEmail4">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <hr class="my-4">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputPassword5">New Password</label>
                        <input type="password" type="password"
                            name="password" 
                            required autocomplete="new-password" class="form-control" id="inputPassword5">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="inputPassword6">Confirm Password</label>
                        <input type="password" type="password"
                            name="password_confirmation"  required autocomplete="new-password" class="form-control" id="inputPassword6">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="mb-2">Password requirements</p>
                    <p class="small text-muted mb-2"> To create a new password, you have to meet all of the following requirements: </p>
                    <ul class="small text-muted pl-4 mb-0">
                        <li> Minimum 8 character </li>
                        <li>At least one special character</li>
                        <li>At least one number</li>
                        <li>Can’t be the same as a previous password </li>
                    </ul>
                </div>
            </div>
            <div class="flex items-center justify-end items-center mt-0">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
        </form>
    </div>
</div>
@endsection