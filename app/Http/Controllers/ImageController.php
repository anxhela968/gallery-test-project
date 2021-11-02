<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $images = Image::withCount(['favorites' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->latest()->get();

        return view('home', ['images' => $images]);
    }

    public function showImageForm()
    {
        return view('imageForm');
    }

    public function uploadImageForm(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]); //validimi i formes

        $path = $request->image->store('images', 'public');

         Image::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $path
        ]); // kalimi/krijimi i fotove ne database. Image::(eshte modeli)
        
        return redirect('/');

    }
}
