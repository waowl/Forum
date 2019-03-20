<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(Channel $channel, Thread $thread)
    {
        $thread->addReply([
           'body' => \request('body'),
           'user_id' => auth()->id()
        ]);

        return back();
    }
}
