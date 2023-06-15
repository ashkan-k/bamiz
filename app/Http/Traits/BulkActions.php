<?php

namespace App\Http\Traits;

trait BulkActions
{
    public $bulk_action_items = [];
    public $bulk_action_selected_items = [];
    public $bulk_action = '';

    public function AddItemsToBulkAction($new_item)
    {
        if (is_array($new_item)) {
            $this->bulk_action_selected_items = $new_item;
        } else {
            array_push($this->bulk_action_selected_items, $new_item);
        }
    }

    public function SubmitBulkActionConfirm()
    {
        if (count($this->bulk_action_selected_items) == 0){
            $this->dispatchBrowserEvent('triggerBulkActionConfirm', ['status' => 'error','message' => 'حداقل یک آیتم را برای انجام عملیات انتخاب کنید!']);
        }

        if (!$this->bulk_action){
            $this->dispatchBrowserEvent('triggerBulkActionConfirm', ['status' => 'error','message' => 'لطفا یک عملیات انتخاب کنید!']);
        }
//        dd('bulkaction button submitted', $this->bulk_action_selected_items);
    }
}
