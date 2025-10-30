<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Donation;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function landing()
    {
        return view('landing', [
            'title' => 'Ngamal Yuk',
            'categories' => Category::all(),
            'donations' => Donation::with(['category'])->limit(4)->latest()->get(),
        ]);
    }

    public function ngamal(Request $request)
    {
        $donations = Donation::with(['category'])->latest()->get();
        // filter by category
        if ($request->category) {
            $donations = Donation::where('category_id', $request->category)->latest()->get();
        }
        return view('ngamal', [
            'title' => 'Ngamal Yuk',
            'categories' => Category::all(),
            'donations' => $donations,
        ]);
    }

    public function detail(Donation $donation)
    {
        return view('detail', [
            'title' => 'Ngamal Yuk | ' . $donation->title,
            'donation' => $donation->load('category'),
        ]);
    }

    public function riwayat()
    {
        return view('riwayat', [
            'title' => 'Riwayat Donasi',
            'mydonations' => Payment::with(['user', 'donation.category'])->where('user_id', Auth::id())->latest()->get(),
        ]);
    }

    public function login()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function actionLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials['role'] = 'user';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('error', 'Login failed!');
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'Register',
        ]);
    }

    public function actionRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|min:8|max:255',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect('/');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
