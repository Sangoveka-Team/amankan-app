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
    public function login(){
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
}
