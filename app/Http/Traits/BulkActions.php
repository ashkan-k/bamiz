<?php

namespace App\Http\Traits;

trait BulkActions
{
    public function SubmitBulkAction($selected_items, $action)
    {
        // TODO handle bulk actions submited
        $this->dispatchBrowserEvent('itemBulkActionsUpdated', ['message' => 'عملیات مورد نظر با موفقیت انجام شد.']);
        $this->resetPage();
    }
}
