<?php

namespace App\Http\Traits;

trait BulkActions
{
    public $bulk_action_items = [];
    public $bulk_action_selected_items = [];
    public $bulk_action = '';

    public function AddItemsToBulkAction($new_item, $value)
    {
        if (is_array($new_item)) {
            if ($value) {
                $this->bulk_action_selected_items = $new_item;
            } else {
                $this->bulk_action_selected_items = [];
            }
        } else {
            if ($value) {
                array_push($this->bulk_action_selected_items, $new_item);
            } else {
                // TODO should remove item from selected list
            }

        }

//        dd($this->bulk_action_selected_items);
    }

    public function SubmitBulkAction()
    {
        dd('bulkaction button submitted', $this->bulk_action_selected_items);
    }
}
