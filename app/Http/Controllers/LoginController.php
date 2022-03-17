<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function loginVK() {
        
        return Socialite::with('vkontakte')->redirect();

    }

    public function responseVK(UserRepo $userRepository) {

        $user = Socialite::driver('vkontakte')->user();
        session(['soc.token' => $user->token]);
        $userInDb = $userRepository->getUserBySocId($user, 'vk');
        Auth::login($userInDb);

        return redirect()->route('admin.news.index');
        
    }
}
