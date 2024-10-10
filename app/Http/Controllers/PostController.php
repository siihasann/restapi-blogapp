<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Get all posts
    public function index()
    {
        $posts = Post::with('comments')->get();
        if ($posts->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "not posts available"
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $posts
        ], 200);
    }


    // Get With ID
    public function show($id)
    {
        $post = Post::with('comments')->find($id);
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => "Post with id $id not found."
            ], 404);
        }
        if ($post->comments->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "No comment found for the post with ID $id ."
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $post
        ],200);
    }

    // Create Post
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => "required|string|min:2",
            'content' => "required|string|max:255"
        ]);
        $post = Post::create($validateData);
        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => $post
        ], 201);
    }

    // Update Post
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'title' => "required|string|min:2",
            'content' => "required|string|max:255"
        ]);       
        try {
            $post = Post::findOrFail($id);

            $post->update($validateData);
            return response()->json([
                'success' => true,
                'message' => "updating data post successfully ",
                'data' => $post
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => "Post dengan ID {$id} tidak ditemukan."
            ], 404);
        };
    }

    // Update Post
    public function destroy($id)
    {
        $post = Post::destroy($id);
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => "Post with id $id not found."
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message'=> "delete post id $id successfully",
            'data' => $post
        ],200);
    }

    public function search(Request $request)
    {
        return Post::where('title', 'like', '%' . $request->query('search') . '%')->get();
    }
}

