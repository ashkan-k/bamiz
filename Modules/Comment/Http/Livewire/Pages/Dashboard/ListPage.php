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
    public $status;
    public $data;
    protected $items;

    protected $listeners = ['triggerChangeStatusModal'];

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

    public function destroy(Comment $comment)
    {
        $comment->delete();
    }

    // Change User Status
    public function triggerChangeStatusModal(Comment $comment)
    {
        $this->item = $comment;
        $this->data['status'] = $comment->status;
    }

    public function ChangeStatus()
    {
        $this->item->status = $this->data['status'];
        $this->item->save();
        $this->dispatchBrowserEvent('itemStatusUpdated');
    }

    private function FilterByStatus()
    {
        $this->items = $this->status ? $this->items->where(['status' => $this->status]) : $this->items;
        return $this->items;
    }

    public function render()
    {
        $this->items = Comment::Search($this->search)->latest();
        $this->items = $this->FilterByStatus();
        return view('comment::livewire.pages.dashboard.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
