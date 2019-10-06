<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'signup', 'store', 'index', 'confirmEmail']]);
        $this->middleware('guest', [
            'only' => 'signup'
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function signup()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password)
        // ]);
        // Auth::login($user);
        // Auth::login($user);
        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'hakeer@qq.com';
        $name = 'hakeer';
        $to = $user->email;
        $subject = "感谢注册 HAKEER 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }


    public function show(User $user)
    {
        $statuses = $user->statuses()->orderBy('created_at', 'DESC')->paginate(15);
        return view('users.show', compact('user', 'statuses'));
    }


    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }


    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50'
        ]);

        $date = [];
        $date['name'] = $request->name;
        if ($request->password) {
            $date['password'] = bcrypt($request->password);
        }
        $user->update($date);
        session()->flash('success', '个人资料更新成功');
        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '删除用户成功');
        return back();
    }
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->first();
        if ($user) {
            $user->activated = true;
            $user->activation_token = null;
            $user->save();
            Auth::login($user);
            session()->flash('success', '恭喜你，激活成功！');
            return redirect()->route('users.show', [$user]);
        } else {
            session()->flash('warning', '激活失败，请查看邮件重新激活');
            return redirect('/');
        }
    }
    public function fans(User $user)
    {
        $users = $user->fans()->paginate(30);
        $title = $user->name . '的粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }
    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = $user->name . '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }
    public function friend($user_id)
    {
        Auth::user()->friend($user_id);
        return back();
    }
    public function unfriend($user_id)
    {
        Auth::user()->unfriend($user_id);
        return back();
    }
}
