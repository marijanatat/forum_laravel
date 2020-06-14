<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show()
    {
       $search = request('q');
       //$threads = Thread::search($search)->paginate(25);
       $threads = Thread::where('title', 'like', "%{$search}%")->orWhere('body', 'like', "%{$search}%")->paginate(10);
        // $threads = Thread::search(request('q'))->paginate(25);

        // if (request()->expectsJson()) {
        //     return $threads;
        // }
        return view('threads.index',compact('threads'));
       // return view('threads.index',compact('threads'));
    }
}
