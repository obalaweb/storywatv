<?php
namespace App\Livewire;

use App\Models\Comment;
use Firefly\FilamentBlog\Models\Comment as ModelsComment;
use Livewire\Component;

class CommentForm extends Component
{
    public $postId;
    public $name = '';
    public $email = '';
    public $body = '';
    public $parentId = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'body' => 'required|string',
    ];

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function reply($parentId)
    {
        $this->parentId = $parentId;
    }

    public function submit()
    {
        $this->validate();

        ModelsComment::create([
            'post_id' => $this->postId,
            'user_id' => auth()->id() ?? null,
            'name' => $this->name,
            'email' => $this->email,
            'body' => $this->body,
            'parent_id' => $this->parentId,
        ]);

        $this->reset(['name', 'email', 'body', 'parentId']);
        $this->emit('commentAdded');
    }

    public function render()
    {
        return view('livewire.comment-form');
    }
}
