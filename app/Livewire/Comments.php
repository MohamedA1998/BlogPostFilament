<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Comments extends Component
{
    public Post $post;

    public string $comment;

    public function CreateComment()
    {
        $this->validate([
            'comment' => 'required|min:3|max:200'
        ]);

        $this->post->comments()->create([
            'user_id'   => auth()->id(),
            'comment' => $this->comment
        ]);

        $this->reset('comment');
    }

    #[Computed()]
    public function comments()
    {
        return $this->post?->comments()->with('user')->latest()->get();
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
