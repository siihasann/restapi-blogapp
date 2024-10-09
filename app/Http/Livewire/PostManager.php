<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;

class PostManager extends Component
{
    public $posts, $title, $content, $postId;
    public $isModalOpen = false;

    // Properti untuk komentar
    public $comments = [];
    public $commentContent, $commentId, $currentPostId;
    public $isCommentModalOpen = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ];

    // Aturan validasi untuk komentar
    protected $commentRules = [
        'commentContent' => 'required|string',
    ];

    public function mount()
    {
        $this->fetchPosts();
    }

    public function fetchPosts()
    {
        $this->posts = Post::with('comments')->latest()->get();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    public function save()
    {
        $this->validate();

        if ($this->postId) {
            $post = Post::find($this->postId);
            $post->update(['title' => $this->title, 'content' => $this->content]);
            session()->flash('message', 'Post updated successfully.');
        } else {
            Post::create(['title' => $this->title, 'content' => $this->content]);
            session()->flash('message', 'Post created successfully.');
        }

        $this->closeModal();
        $this->fetchPosts();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->openModal();
    }

    public function delete($id)
    {
        Post::destroy($id);
        session()->flash('message', 'Post deleted successfully.');
        $this->fetchPosts();
    }

    public function resetInputFields()
    {
        $this->title = '';
        $this->content = '';
        $this->postId = null;
    }

    // Metode untuk membuka modal komentar
    public function openCommentModal($postId)
    {
        $this->currentPostId = $postId;
        $this->isCommentModalOpen = true;
        $this->comments = Post::find($postId)->comments;
    }

    public function closeCommentModal()
    {
        $this->isCommentModalOpen = false;
        $this->resetCommentFields();
    }

    public function saveComment()
    {
        $this->validate($this->commentRules);

        if ($this->commentId) {
            $comment = Comment::findOrFail($this->commentId);
            $comment->update(['comment' => $this->commentContent]);
            session()->flash('message', 'Comment updated successfully.');
        } else {
            Comment::create([
                'post_id' => $this->currentPostId,
                'comment' => $this->commentContent,
            ]);
            session()->flash('message', 'Comment added successfully.');
        }

        $this->closeCommentModal();
        $this->fetchPosts();
    }

    public function editComment($id)
    {
        $comment = Comment::findOrFail($id);
        $this->commentId = $id;
        $this->commentContent = $comment->comment;
        $this->openCommentModal($comment->post_id);
    }

    public function deleteComment($id)
    {
        Comment::destroy($id);
        session()->flash('message', 'Comment deleted successfully.');
        $this->fetchPosts();
    }

    public function resetCommentFields()
    {
        $this->commentContent = '';
        $this->commentId = null;
    }

    public function render()
    {
        return view('livewire.post-manager');
    }
}
