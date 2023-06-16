<?php

namespace App\Http\Traits;

trait BulkActions
{
    public function SubmitBulkAction($items, $action, $model)
    {
        $model = str_replace('::class', '', $model);
//        if (!in_array($action, $model::$bulk_actions)){
//            return $this->FailResponse('عملیات مورد نظر مجاز نیست!');
//        }

        try {
            if ($action == 'delete') {
                $model::whereIn('id', $items)->delete();
            } else if ($action == 'is_approve') {
                $model::whereIn('id', $items)->update(['is_approved' => 1]);
            } else if ($action == 'is_reject') {
                $model::whereIn('id', $items)->update(['is_approved' => 0]);
            } else if ($action == 'success') {
                $model::whereIn('id', $items)->update(['status' => 1]);
            } else if ($action == 'fail') {
                $model::whereIn('id', $items)->update(['status' => 0]);
            } else if ($action == 'approve_status') {
                $model::whereIn('id', $items)->update(['status' => 'approved']);
            } else if ($action == 'reject_status') {
                $model::whereIn('id', $items)->update(['status' => 'reject']);
            } else if ($action == 'pending_status') {
                $model::whereIn('id', $items)->update(['status' => 'pending']);
            } else if ($action == 'done_status') {
                $model::whereIn('id', $items)->update(['status' => 'done']);
            } else if ($action == 'end_status') {
                $model::whereIn('id', $items)->update(['status' => 'end']);
            } else if ($action == 'block') {
                $model::whereIn('id', $items)->ChangeBlockStatus(true);
            } else if ($action == 'unblock') {
                $model::whereIn('id', $items)->ChangeBlockStatus(false);
            } else if ($action == 'cash') {
                $model::whereIn('id', $items)->ChangeType(true);
            } else if ($action == 'free') {
                $model::whereIn('id', $items)->ChangeType(false);
            } else if ($action == 'active') {
                $model::whereIn('id', $items)->ChangeActiveStatus(true);
            } else if ($action == 'deactive') {
                $model::whereIn('id', $items)->ChangeActiveStatus(false);
            }
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('itemBulkActionsUpdated', ['type' => 'error', 'message' => $exception->getMessage()]);
            $this->resetPage();
        }

        $this->dispatchBrowserEvent('itemBulkActionsUpdated', ['type' => 'success', 'message' => 'عملیات مورد نظر با موفقیت انجام شد.']);
        $this->resetPage();
    }
}
