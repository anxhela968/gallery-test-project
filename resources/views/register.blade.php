@extends('layouts.guest')
@section('title', 'Register')
@section('content')
    <div class="row mt-5">
        <div class="col">
            <h1> SMALL GALLERY</h1>
            <h5>This repository is a small gallery with different photos from different backgrounds.</h5>
        </div>
        <div class="col">
            <form action="/register" method="post">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="asd" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="asd" name="password_confirmation">
                    @error('password_confirmation')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Register now</button>
            </form>
        </div>
    </div>
@endsection
