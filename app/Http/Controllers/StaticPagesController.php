<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Status;
use App\User;

class StaticPagesController extends Controller
{
    public function home()
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(8);
        }
        // dd($feed_items);
        return view('static_pages.home', compact('feed_items'));
    } //
    public function about()
    {
        return view('static_pages.about');
    }
    public function help()
    {
        return view('static_pages.help');
    }
}
