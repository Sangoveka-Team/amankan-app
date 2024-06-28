<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Helper\ApiFormatter;
use Exception;

class ProfileController extends Controller
{
    public function profile(){
        try {
            $user = User::find(auth()->user()->id);

            return ApiFormatter::createApi(200, 'success', $user);

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }

    public function updateProfile(Request $request){
        try {
            $user = User::findOrFail(auth()->user()->id);

            $user->username = $request->username;
            $user->name = $request->name;
            $user->number = $request->number;
            $user->alamat = $request->alamat;
            $user->lokasi_rumah = $request->lokasi_rumah;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('img'), $imageName);
                $path =  "img/" . $imageName;
                
                $user->image = $path;
            } else {
                $user->image = $user->image;
            }

            // dd($request->nama);

            if ($user->update()) {
                return ApiFormatter::createApi(200, 'success', $user);
            } else{
            return ApiFormatter::createApi(401, 'failed');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }
}
