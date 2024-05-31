<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
// use App\Http\Requests\Auth\UserLoginRequest;
// use App\Http\Requests\Auth\UserRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "email" => "required|email|unique:users",
                "password" =>  "required|min:4",
            ],[
                "name.required" => "Ad alanını boş bırakmayınız",
                "email.required" => "Email alanını boş bırakmayınız",
                "email.email" => "Geçerli bir mail adresi giriniz",
                "email.unique" => "Bu mail başka bir kullanıcı tarafından kullanılmaktadır",
                "password.required"=> "Şifre alanını boş bırakmayınız",
                "password.min"=> "Şifre alanı en az 4 karakterden oluşmalıdır",
            ]);

            $user = User::create([
                "name" => $request["name"],
                "email" => $request["email"],
                "password" => bcrypt($request["password"]),
            ]);

            $token = $user->createToken("myapptoken")->plainTextToken;
            return response()->json([
                "status" => "success",
                "message" => "Kaydınız başarıyla oluşturuldu",
                "user" => $user,
                "token" => $token,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                "status" => "error",
                "errors" => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                "email" => "required|email",
                "password" =>  "required",
            ],[
                "email.required" => "Email alanını boş bırakmayınız",
                "email.email" => "Geçerli bir mail adresi giriniz",
                "password.required"=> "Şifre alanını boş bırakmayınız",
            ]);

            $user = User::where("email", $request["email"])->first();

            if (!$user) {
                return response()->json([
                    'message' => 'Email bulunamadı'
                ], 404);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Şifre yanlış'
                ], 401);
            }

            $token = $user->createToken("myapptoken")->plainTextToken;
            return response()->json([
                "status" => "success",
                "message" => "Giriş başarılı, Hoşgeldiniz..",
                "user" => $user,
                "username" =>$user->name,
                "token" => $token,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                "status" => "error",
                "errors" => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "status" => "success",
            "message" => "Çıkış Başarılı"
        ]);
    }
}
