<?php


namespace App\Models\Auth;


use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Auth as SAuth;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\InputBag;

class Auth extends User
{

    public static function login(Request $request)
    {
        $login     = $request->post('login');
        $password  = $request->post('password');
        $user      = User::query()->where('email', '=', $login)->orWhere('phone', '=', $login)->first();
        $loginType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $remember  = $request->post('remember') ? true : false;

        if ($user &&
            Hash::check($password, $user->password) &&
            SAuth::attempt([$loginType => $login, User::ATTR_PASSWORD => $password], $remember) ) {

            return redirect()->back();
//            return \auth()->user()->role === User::ROLE_ADMIN ? redirect('/admin') : redirect('/cabinet');
        }

        $errors = new MessageBag(['password' => ['Неверный логин или пароль']]);
        return redirect()->back()->withErrors($errors)->withInput();
    }

    private static function validateLogin(Request $request, $loginType)
    {
        return $request->validate([
            $loginType => 'required|string',
            'password' => 'required|string',
        ]);
    }

}
