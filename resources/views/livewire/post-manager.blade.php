<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Manage Posts</h2>
        <button 
            wire:click="openModal" 
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
        >
            Add New Post
        </button>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Posts Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-6 text-left text-sm font-medium text-gray-700">ID</th>
                    <th class="py-3 px-6 text-left text-sm font-medium text-gray-700">Title</th>
                    <th class="py-3 px-6 text-left text-sm font-medium text-gray-700">Content</th>
                    <th class="py-3 px-6 text-center text-sm font-medium text-gray-700">Actions</th>
                    <th class="py-3 px-6 text-center text-sm font-medium text-gray-700">Comments</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-4 px-6">{{ $post->id }}</td>
                        <td class="py-4 px-6">{{ $post->title }}</td>
                        <td class="py-4 px-6">{{ Str::limit($post->content, 50) }}</td>
                        <td class="py-4 px-6 text-center">
                            <button 
                                wire:click="edit({{ $post->id }})" 
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 mr-2"
                            >
                                Edit
                            </button>
                            <button 
                                wire:click="delete({{ $post->id }})" 
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                onclick="confirm('Are you sure you want to delete this post?') || event.stopImmediatePropagation()"
                            >
                                Delete
                            </button>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <button 
                                wire:click="openCommentModal({{ $post->id }})" 
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
                            >
                                View Comments
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-6 text-center">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Post Modal -->
    @if($isModalOpen)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-lg w-1/2 p-6">
                <h3 class="text-xl font-semibold mb-4">
                    {{ $postId ? 'Edit Post' : 'Add New Post' }}
                </h3>

                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label class="block text-gray-700">Title</label>
                        <input 
                            type="text" 
                            wire:model="title" 
                            class="w-full px-3 py-2 border rounded"
                            placeholder="Post Title"
                        >
                        @error('title') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Content</label>
                        <textarea 
                            wire:model="content" 
                            class="w-full px-3 py-2 border rounded" 
                            placeholder="Post Content"
                        ></textarea>
                        @error('content') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button 
                            type="button" 
                            wire:click="closeModal" 
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Comment Modal -->
    @if($isCommentModalOpen)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-lg w-3/4 p-6">
                <h3 class="text-xl font-semibold mb-4">Manage Comments for Post ID: {{ $currentPostId }}</h3>

                <!-- Add/Edit Comment Form -->
                <form wire:submit.prevent="saveComment" class="mb-6">
                    <div class="mb-4">
                        <label class="block text-gray-700">Comment</label>
                        <textarea 
                            wire:model="commentContent" 
                            class="w-full px-3 py-2 border rounded" 
                            placeholder="Enter your comment"
                        ></textarea>
                        @error('commentContent') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button 
                            type="button" 
                            wire:click="closeCommentModal" 
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                        >
                            {{ $commentId ? 'Update Comment' : 'Add Comment' }}
                        </button>
                    </div>
                </form>

                <!-- Comments List -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-3 px-6 text-left text-sm font-medium text-gray-700">ID</th>
                                <th class="py-3 px-6 text-left text-sm font-medium text-gray-700">Comment</th>
                                <th class="py-3 px-6 text-center text-sm font-medium text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comments as $comment)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="py-4 px-6">{{ $comment->id }}</td>
                                    <td class="py-4 px-6">{{ Str::limit($comment->comment, 100) }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <button 
                                            wire:click="editComment({{ $comment->id }})" 
                                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 mr-2"
                                        >
                                            Edit
                                        </button>
                                        <button 
                                            wire:click="deleteComment({{ $comment->id }})" 
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                            onclick="confirm('Are you sure you want to delete this comment?') || event.stopImmediatePropagation()"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-4 px-6 text-center">No comments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end mt-4">
                    <button 
                        type="button" 
                        wire:click="closeCommentModal" 
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
