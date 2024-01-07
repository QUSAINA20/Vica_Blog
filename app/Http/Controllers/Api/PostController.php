<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'tags', 'user')->get();

        $formattedPosts = $posts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'category' => [
                    'id' => $post->category->id,
                    'title' => $post->category->title,
                    'image' => url('images/' . $post->category->image), // Assuming images are in the public/images directory
                ],
                'tags' => $post->tags->map(function ($tag) {
                    return [
                        'id' => $tag->id,
                        'name' => $tag->name,
                    ];
                }),
                'user' => [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                    'email' => $post->user->email,
                    'image' => url('images/' . $post->user->image),
                ],
            ];
        });

        return response()->json(['posts' => $formattedPosts]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags'          => 'required|array|min:1|max:5',
            'tags.*'        => 'required|exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        $validatedData['user_id'] = auth()->user()->id;

        $post = Post::create($validatedData);

        if (!empty($validatedData['tags'])) {
            $post->tags()->attach($request->tags);
        }

        return response()->json(['message' => 'Post created successfully', 'post' => $post]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('category', 'tags', 'user', 'comments');

        $formattedPost = [
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->content,
            'image' => url('images/' . $post->image), // Assuming images are in the public/images directory

            'category' => [
                'id' => $post->category->id,
                'title' => $post->category->title,
                'image' => url('images/' . $post->category->image), // Assuming images are in the public/images directory
            ],
            'tags' => $post->tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'title' => $tag->title,
                ];
            }),
            'user' => [
                'id' => $post->user->id,
                'name' => $post->user->name,
                'email' => $post->user->email,
                'image' => url('images/' . $post->user->image),
            ],
            'comments' => $post->comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'user' => [
                        'id' => $comment->user->id,
                        'name' => $comment->user->name,
                        'email' => $comment->user->email,
                        'image' => url('images/' . $comment->user->image),
                    ],
                ];
            }),
        ];

        return response()->json(['post' => $formattedPost]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // dd($request);
        $this->authorize('update', $post);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags'          => 'required|array|min:1|max:5',
            'tags.*'        => 'required|numeric|exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        $post->update($validatedData);

        $post->tags()->sync($request->tags);

        return response()->json(['message' => 'Post updated successfully', 'post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
