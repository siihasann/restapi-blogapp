<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('post')->get();
        if ($comments->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'not comment available'
            ], 404);    
        }
        return response()->json([
            'success' => true,
            'data' => $comments
        ], 200);
        // return Comment::with('post')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $validateData = $request->validate([
            'comment' => 'required|string|max:255',
        ]);
        
        try {
            $post = Post::findOrFail($post_id);


            $comment = new Comment();
            $comment->comment = $validateData['comment'];
            $comment->post_id = $post->id;

            $comment->save();
            return response()->json([
                'success' => true,
                'message' => "Comment addes successfully",
                'data' => $comment,

            ], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => "Post dengan ID {$post_id} not found",
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $comment = Comment::with('post')->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $comment
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => "Comment with ID $id not found"

            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'comment' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);
        try {
            $comment = Comment::findOrFail($id);

            $post = Post::findOrFail($validateData['post_id']);
            $comment->comment = $validateData['comment'];
            $comment->post_id = $post->id;
            $comment->save();
            return response()->json([
                'success' => true,
                'message' => "Comment update successfully",
                'data' => $comment
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'messages' => "comment with ID $id not found",
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $comment = Comment::destroy($id);

        if (! $comment) {
            return response()->json([
                'success' => false,
                'message' => "Comment with ID $id not found"
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => "delete comment with ID $id successfully"
        ], 200);
    }

    // Pencarian komentar
    public function search(Request $request)
    {
        return Comment::where('comment', 'like', '%' . $request->query('search') . '%')->get();
    }
}
