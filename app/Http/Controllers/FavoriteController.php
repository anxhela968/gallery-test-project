<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Image;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $images = Image::withCount(['favorites' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])
        ->latest()
        ->having('favorites_count', '>', 0)
        ->get();

        return view('home', ['images' => $images]);
    }

    public function markAsFavorite(Request $request)
    {
        $this->validate($request, [
            'image_id' => 'required|int'
        ]);


        $user = Auth::user();

        Favorite::create([
            'user_id' => $user->id,
            'image_id' => $request->image_id
        ]);

        return redirect('/');
    }

    public function markAsUnfavorite(Request $request)
    {
        $this->validate($request, [
            'image_id' => 'required|int'
        ]);


        $user = Auth::user();

        Favorite::where('image_id', $request->image_id)
            ->where('user_id', $user->id)
            ->delete();

        return redirect('/');
    }
}
