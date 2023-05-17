<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserShowController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $user->load(['posts.user']);

        return inertia()->render('Users/Show', [
            'user' => UserResource::make($user),
            'posts' => PostResource::collection($user->posts),
        ]);
    }
}
