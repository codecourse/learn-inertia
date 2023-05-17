<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentIndexController extends Controller
{
    public function __invoke()
    {
        return inertia()->render('Comments/Index');
    }
}
