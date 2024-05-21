<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use \Illuminate\Support\Facades\URL;
use App\Helper\ApiFormatter;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthController extends Controller
{
    public function register(){
        $request->validate( [
            'nama' => 'required|string',
            'email' => 'required|email:dns|min:3|max:255|unique:users',
            'password' => 'required|min:5|max:255',
            'nomor' => 'required',
        ]);

        try {
            $user = New User();
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->nomor = '62' . $request->nomor;
            $user->poin = 0;
            $user->daerah = '-';

            if($user->save()){
                return ApiFormatter::createApi(200, 'register berhasil', $user);
            } else{
                return ApiFormatter::createApi(401, 'register gagal');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'register gagal', $error); 
        }
    }

    public function login(Request $request){
        try {
            $credentials = $request->validate( [
                'username' => 'required',
                'password' => 'required|min:5',
            ]);
    
            if (Auth::attempt($credentials)) {
                $user = User::where('username', $request->username)->first();
                $token = $user->createToken('token')->plainTextToken;

                $data = [
                    "token" => $token,
                    "userRole" => $user->role,
                    "userEmailVerified" => $user->email_verified_at,
                ];

                return ApiFormatter::createApi(200, 'Authenticated User', $data);
                
            } else {
                return ApiFormatter::createApi(401, 'Login Failed');
                
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(422, 'invalid', $error);
        }
    }


    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return ApiFormatter::createApi(200, "logout success");
    }


    // public function forgotPassword(Request $request){
    //     try {
    //         $user = User::where('email', $request->email)->get();

    //         if (count($user) > 0) {
    //             $token = Str::random(50);
    //             $domain = URL::to('/');
    //             $url = $domain . '/reset-password?token=' . $token;

    //             $data = [
    //                 'url' => $url,
    //                 'email' => $request->email,
    //                 'title' => 'Password Reset',
    //                 'body' => 'Please click on below link to reset your password',
    //             ];

    //             Mail::send('forgotPasswordMail', ['data' => $data], function($message) use ($data){
    //                 $message->to($data['email'])->subject($data['title']);
    //             });

    //             $dateTime = Carbon::now()->format('Y-m-d H:i:s');
    //             PasswordReset::updateOrCreate(
    //                 ['email' => $request->email],
    //                 [
    //                     'email' => $request->email,
    //                     'token' => $token,
    //                     'created_at' => $dateTime,
    //                 ]
    //             );

    //             return ApiFormatter::createApi(200, 'Please Check Your Email to Reset your Password');

    //         } else {
    //             return ApiFormatter::createApi(404, 'User not found');
    //         }
            
    //     } catch (Exception $error) {
    //         return ApiFormatter::createApi(401, 'Failed', $error);

    //     }
    // }
}
