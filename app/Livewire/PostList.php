<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search = '';

    #[Url()]
    public $category = '';

    #[Url()]
    public $papular = false;

    public function setSort($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }

    #[Computed()]
    public function posts()
    {
        return Post::with('categorys', 'user')
            ->Published()
            ->when($this->category != '', fn ($query) => $query->WithCategory($this->category))
            ->when($this->papular, fn ($query) => $query->Popular())
            ->Search($this->search)
            ->orderBy('published_at', $this->sort)
            ->paginate(3);
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
