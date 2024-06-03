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
}
