<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Instrument;
use App\Models\Reservation;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //User Landing Handle

    public function landHandling(){

        $user = Auth::user();

        $user = auth() -> user();

        if ($user){
            $is_admin = $user->is_admin;

            if ($is_admin == 1) {
                return redirect('/admin/dashboard');
            } else if ($is_admin == 0) {
                return redirect('/homepage');
            }
        }

        return redirect('/login');

    }

    /* ======================== LOGIN HANDLING ======================== */
    // Show Login Page
    public function loginPage(){
        return view('auth.login');
    }

    //Login Logic
    public function login(Request $request){
        $request->validate([
            'username'    => 'required|username',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Check user's role and redirect accordingly
            if ($user->is_admin == 0) {
                return redirect('/homepage'); // Pass instruments to homepage view for customers
            } elseif ($user->is_admin == 1) {
                return redirect('/admin/dashboard'); // Redirect to adminpage for admins
            }

            return redirect('/');

        }
        // Authentication failed
        return back()->withErrors(['email' => 'Email atau Password yang anda masukkan salah!']);
    }

    /* REGISTER HANDLING */
    //Show Register Page
    public function registerPage(){
        return view('auth.register');
    }

    //Register Logic
    public function register(Request $request){
        // Create and save the user
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect to home or dashboard
        return redirect('/');
    }

    /* LOGOUT HANDLING */
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    /* ======================== HOMEPAGE ======================== */
    public function homePage(Request $request){

        $search = $request->input('search');
    
        // Use conditional query to fetch instruments based on search input
        $instruments = $search 
            ? Instrument::where('name', 'like', '%' . $search . '%')->get()
            : Instrument::all();
    
        return view('user.home', compact('instruments', 'search'));
    }

    //SEARCH INSTRUMENT IN HOMEPAGE
    public function homepageSearch(Request $request){

        $instruments = Instrument::all();
        return $this->homePage($request);

    }
    
}
