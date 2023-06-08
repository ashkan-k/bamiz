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
    public $status;
    protected $items;
    public $status_filter_items = [
        ['id' => 'draft', 'name' => 'پیش نویس'],
        ['id' => 'publish', 'name' => 'انتشار'],
        ['id' => 'done', 'name' => 'پایان انتشار'],
    ];

    public function mount()
    {
        $this->status = request('status');
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

    private function FilterByStatus()
    {
        $this->items = $this->status ? $this->items->where(['status' => $this->status]) : $this->items;
        return $this->items;
    }

    public function render()
    {
        $this->items = Article::Search($this->search)->latest();
        $this->items = $this->FilterByStatus();
        return view('article::livewire.pages.dashboard.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
