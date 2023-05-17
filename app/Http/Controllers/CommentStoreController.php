<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request)
    {
        // sleep(2);

        $this->validate($request, [
            'body' => ['required']
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back()->with('message', 'Comment posted!');
    }
}
