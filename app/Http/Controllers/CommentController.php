<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        // Create the comment associated with the post and the authenticated user
        $comment = Comment::create([
            'content' => $validatedData['content'],
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]);

        // Redirect back to the post with a success message
        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validatedData = $request->validate([
            'content' => 'required',
        ]);


        $comment->update([
            'content' => $validatedData['content'],
        ]);

        // Redirect back to the post with a success message
        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment added successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        // Delete the comment
        $comment->delete();

        // Redirect to the comments index with a success message
        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully');
    }
}
