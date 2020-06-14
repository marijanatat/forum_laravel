<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilters;
use App\Rules\Recaptcha;
use App\Rules\SpamFree;
use App\Thread;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);
        /** just for test */
        // if (request()->wantsJson()) {
        //     return $threads;// }
        return view('threads.index', compact('threads'));
    }


    public function create()
    {
        return view('threads.create');
    }


    public function store(Request $request, Recaptcha $recaptcha)
    {
        $request->validate([
            'title' => ['required', new SpamFree],
            'body' => ['required', new SpamFree],
            'channel_id' => 'required|exists:channels,id',
            'g-recaptcha-response' => ['required', $recaptcha]
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body'),
            //'slug'=>request('title') nije vise potrebno uveden je boot u thread created
        ]);
        return redirect($thread->path())->with('flash', 'Your thread has been published!');
    }



    public function show($channel, Thread $thread)
    {
        if (auth()->check()) {
            auth()->user()->read($thread);
        }
        $thread->increment('visits');
        return view('threads.show', compact('thread'));
    }


    public function edit(Thread $thread)
    {
        //
    }


    public function update($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $data = request()->validate([
            'title' => ['required', new SpamFree],
            'body' => ['required', new SpamFree]
        ]);

        $thread->update($data);
        return $thread;
    }


    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);
        $thread->delete();
        return redirect('threads');
    }

    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads->latest()->paginate(25);
    }

    public function toSearchableArray()
    {
        return $this->toArray()+ ['path'=>$this->path()]; 
    }
}
