<?php

namespace Modules\Comment\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Comment\Entities\Comment;

class ListPage extends Component
{
    use WithPagination;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    protected $items;

    public function mount()
    {
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination'])) {
            $this->resetPage();
        }
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
    }

    public function render()
    {
        $this->items = Comment::Search($this->search)->latest()->paginate($this->pagination);
        return view('comment::livewire.pages.dashboard.list-page', ['items' => $this->items]);
    }
}
