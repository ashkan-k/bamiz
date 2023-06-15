<?php

namespace App\Http\Traits;

trait BulkActions
{
    public $bulk_action_items = [];
    public $bulk_action_selected_items = [];
    public $bulk_action = null;

    public function AddItemsToBulkAction($new_item)
    {
        if (is_array($new_item)) {
            $this->bulk_action_selected_items = $new_item;
        } else {
            array_push($this->bulk_action_selected_items, $new_item);
        }
    }

    public function SubmitBulkAction()
    {
        dd('bulkaction button submitted', $this->bulk_action_selected_items);
    }
}
