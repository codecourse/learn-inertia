<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke()
    {
        return inertia()->render('Comments/Index', [
            'posts' => PostResource::collection(
                Post::with('user')->latest()->get()
            ),

            'can' => [
                'create_post' => auth()->user()->can('create', Post::class)
            ]
        ]);
    }
}
