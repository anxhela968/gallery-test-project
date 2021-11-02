<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('register'); //kjo ben shfaqjen e formes se register
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]); //validimi i formes

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]); // kalimi/krijimi i datave ne database

        session()->flash('status', 'User has been successfuly registered!');
        
        return redirect('/login');
        
    }

    public function showLoginForm()
    {
        return view('login'); // kjo mundeson shfaqjen e formes se login
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]); //validimi i formes

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }

    public function showProfile()
    {
        $user = Auth::user();

        return view('profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]); //validimi i formes

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]); // update-imi i datave ne database

        session()->flash('status', 'User information has been successfuly updated!');
        return redirect('/profile');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
