<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
     // Display the comments on the one-pager
     public function index()
     {
         $comments = Comment::with('user')->latest()->paginate(5)->fragment('comment');
         return view('home', compact('comments'));
     }

 
     // Store a new comment (only for authenticated users)
     public function store(Request $request)
     {
         $request->validate([
             'email'   => 'required|email',
             'message' => 'required|min:5',
         ]);
 
         Comment::create([
             'user_id' => Auth::id(),
             'email'   => $request->email,
             'message' => $request->message,
         ]);
 
         return back()->with('success', 'Comment added successfully!');
     }
}
