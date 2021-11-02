
@extends('layouts.app')

@section('title', 'Home')

@section('content')
        <div class="d-flex justify-content-end mt-5">
            <a href="/image" class="btn btn-success" type="button">Upload image</a>
        </div>
        <div class="row">
            @forelse ($images as $img)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-5">
                    <div class="card ">
                        <img src="{{ asset('uploads/'.$img->url) }}" class="card-img-top", class="w-100 p-3" >
                        <div class="card-body">
                            <h5 class="card-title">{{ $img->title }}</h5>
                            <p class="card-text">{{ $img->description }}</p>
                            
                            <div class="d-flex justify-content-between">
                                @if ($img->favorites_count)
                                    <form action="/unfavorite" method="post">
                                        @csrf

                                        <input type="hidden" name="image_id" value="{{ $img->id }}">
                                        
                                        <button type="submit" class="btn btn-danger">Unfavorite</button>
                                    </form>
                                @else
                                    <form action="/favorite" method="post">
                                        @csrf

                                        <input type="hidden" name="image_id" value="{{ $img->id }}">
                                        
                                        <button type="submit" class="btn btn-primary">Favorite</button>
                                    </form>
                                @endif

                                <a href="{{ asset('uploads/'.$img->url) }}" class="btn btn-primary" download>Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h5 class="text-center">No images found! Please upload your first image.</h5>
            @endforelse
        </div>

@endsection