<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function __construct(){
        $this->middleware('guest',[
            'only'=>'login'
        ]);
    }
    public function login()
    {
        return view('sessions.login');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            session()->flash('success', '亲爱的小伙伴，欢迎回来！');
            $fallback = route('users.show', [Auth::user()]);
            return redirect()->intended($fallback);
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return back()->withInput();//withInput带旧数据返回
        }
    }
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已经成功退出');
        return redirect('login');
    }
}
