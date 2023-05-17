<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentIndexController extends Controller
{
    public function __invoke()
    {
        return inertia()->render('Comments/Index', [
            'posts' => Post::latest()->get(),
        ]);
    }
}
