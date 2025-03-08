<div>
    <div class="form-comment">
        <div id="respond" class="comment-respond">
            <h3 id="reply-title" class="comment-reply-title">
                Leave a Comment
                @if ($parentId)
                    <small><a href="#" wire:click="resetParent">Cancel Reply</a></small>
                @endif
            </h3>
            <form wire:submit.prevent="submit" class="comment-form">
                <p class="comment-notes">
                    Your email address will not be published. Required fields are marked <span class="required">*</span>
                </p>
                <div class="comment-meta">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="comment-form-author">
                                <input placeholder="Your Name *" wire:model="name" type="text" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="comment-form-email">
                                <input placeholder="Email *" wire:model="email" type="email" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </p>
                        </div>
                    </div>
                </div>
                <div class="comment-message">
                    <p class="comment-form-comment">
                        <textarea placeholder="Enter your comment *" wire:model="body" rows="8" required></textarea>
                        @error('body')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </p>
                </div>
                <p class="form-submit">
                    <button type="submit" class="submit">Submit Comment</button>
                </p>
            </form>
        </div>
    </div>

    <style>
        .comment-form {
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .comment-reply-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .comment-notes {
            color: #666;
            margin-bottom: 15px;
        }

        .required {
            color: #e40914;
        }

        .comment-form input,
        .comment-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .comment-form .submit {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .comment-form .submit:hover {
            background: #0056b3;
        }
    </style>

    <script>
        document.addEventListener('commentAdded', () => {
            Livewire.emit('refreshComments');
        });
    </script>
</div>
