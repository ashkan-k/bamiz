<?php

namespace Modules\Article\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Article\Entities\Article;

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

    public function destroy(Article $article)
    {
        $article->delete();
    }

    public function render()
    {
        $this->items = Article::Search($this->search)->latest()->paginate($this->pagination);
        return view('article::livewire.pages.dashboard.list-page', ['items' => $this->items]);
    }
}
