<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class FrontAuthController extends Controller
{
    public function register()
    {
        return view('auths.register');
    }

    public function postRegister(Request $request)
    {
        try {
            $response = Http::post('http://host.docker.internal/api/register', [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $data = $response->json();

            if (isset($data['status']) && $data['status'] == 'success') {
                return redirect()->route('login')->with('success', $data['message']);
            } else {
                $errors = isset($data['errors']) ? $data['errors'] : [];
                return redirect()->back()->withErrors($errors)->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Bilinmeyen bir hata oluştu.');
        }
    }

    public function login()
    {
        return view('auths.login');
    }

    public function postLogin(Request $request)
{
    try {
        $response = Http::post('http://host.docker.internal/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $data = $response->json();

        if (isset($data['status']) && $data['status'] == 'success') {
            session(['token' => $data['token']]);
            session(['username' => $data['user']['name']]);
            return redirect()->route('products.home')->with('success', $data['message']);
        } else {
            $message = isset($data['message']) ? $data['message'] : [];
            $errors = isset($data['errors']) ? $data['errors'] : [];
            return redirect()->back()->withErrors($errors)->with('error', $message)->withInput();
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Bilinmeyen bir hata oluştu.');
    }
}

    public function logout(Request $request)
    {
        $token = session('token');
        
        if ($token) {
            $response = Http::withToken($token)->post('http://host.docker.internal/api/logout');
            $data = $response->json();
            session()->forget('token');
        }
        return redirect()->route('login')->with('success',$data['message']);
    }
}
