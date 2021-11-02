@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="row mt-5">
        <div class="col">
            <h1> My Profile </h1>
            <h5>This is My Profile section. You can update your information using the form on the right.</h5>
        </div>
        <div class="col">
            @if (session()->has('status'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('status') }}
                </div>
            @endif

            <form action="/profile" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    @error('name')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-success">Edit</button>
            </form>
        </div>
    </div>
@endsection
