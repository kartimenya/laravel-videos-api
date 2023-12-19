<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
   public function index()
   {
        return Comment::query()->get();
   }

   public function show(Comment $comment)
   {
        return $comment;
   }

   public function store(Request $request)
   {
       $attributes = $request->validate([
           'text' => ['required', 'string'],
           'parent_id' => ['exists:comments,id'],
           'video_id' => ['required_without:parent_id', 'exists:videos,id'],
       ]);

       return Comment::query()->create($attributes);
   }

    public function update(Comment $comment, Request $request): void
    {
        Gate::allowIf(fn (User $user) => $comment->isOwenBy($user));

        $attributes = $request->validate([
            'text' => ['required', 'string'],
        ]);

        $comment->fill($attributes)->save();

    }

    public function destroy(Comment $comment, Request $request): void
    {
        Gate::allowIf(fn (User $user) => $comment->isOwenBy($user));

        $comment->delete();
    }
}
