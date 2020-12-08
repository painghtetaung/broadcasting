<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use App\Models\Article;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    // public function __construct()
    // {
    //     return $this->middleware('auth');
    // }

    public function index(Article $article)
    {
        return response()->json($article->comments()->with('user')->latest()->get());
        
    }
    

    public function create(Request $request, Article $article)
    {
        $comment = $article->comments()->create([
            'content' => $request->content,
            'user_id' => Auth::id()
        ]);

        $comment = Comment::where('id', $comment->id)->with('user')->first();
        
        broadcast(new NewComment($comment))->toOthers();
        return $comment->toJson();
    }

    public function delete($id)
    {   
        $comment = Comment::find($id);
        if( Gate::allows('comment-delete', $comment))
        {
            $comment->delete();
            return back();
        } else {
            return back()->with('error', 'Unauthorize');
        }

        return back();
    }
}
