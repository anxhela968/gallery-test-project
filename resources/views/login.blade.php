@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="row mt-5">
        <div class="col">
            <h1> SMALL GALLERY</h1>
            <h5>This repository is a small gallery with different photos from different backgrounds.</h5>
        </div>
        <div class="col">
            @if (session()->has('status'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('status') }}
                </div>
            @endif

            <form action="/login" method="post">
                @csrf

                <div class="mb-3">
                    <label for="email1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email1" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="psw" class="form-label">Password</label>
                    <input type="password" class="form-control" id="psw" name="password" value="{{ old('password') }}">
                    @error('password')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Log in</button>
                <hr>
                <h5>If you are not registered please register now.</h5>
                <a href="/register" class="btn btn-success">Register now</a>
            </form>
        </div>
    </div>
@endsection
