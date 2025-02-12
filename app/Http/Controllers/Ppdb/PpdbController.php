<?php

namespace App\Http\Controllers\Ppdb;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Str;
// use Illuminate\Hashing\BcryptHasher;


use App\Models\User;


class PpdbController extends Controller{


    public function index(){
        return view('ppdb.index');
    }

    public function login(){
        return view('ppdb.auth.login');
    }

    public function loginAttempt(Request $request){
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            Log::warning('Validation failed', ['errors' => $validation->errors()]);
            return redirect()->back()->withErrors($validation)->withInput()->with('error', 'Tidak bisa disimpan!');
        }

        try {
            DB::beginTransaction();
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect, please try again'],
            ]);
            }

            auth()->login($user);
            \Log::info('User logged in successfully', ['email' => $request->email]);

            DB::commit();
            return redirect()->intended(route('ppdb.dashboard'))->with('success', 'Login successful');

        } catch (\Exception $e) {
            DB::rollback(); // Rollback transaction
            Log::error('Login Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return redirect()->back()->withInput()->with(['error' => 'Terjadi error pada server.']);
        }
    }

    public function register(){
        return view('ppdb.auth.register');
    }


    public function registerAttempt(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'jalur_pendaftaran' => 'required|in:Prestasi,Kepemimpinan',
        ]);

        $user = Ppdb::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'jalur_pendaftaran' => $request->jalur_pendaftaran
        ]);

        auth()->login($user);

        return redirect()->route('home')->with('success', 'Registration successful.');
    }

    public function dashboard(){
        return view('ppdb.dashboard.index');
    }



}
