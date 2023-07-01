<?php

namespace Modules\Place\Http\Livewire\Pages\Front;

use App\Http\Traits\CommentTrait;
use Livewire\Component;
use Modules\Comment\Entities\Comment;
use Modules\Reserve\Entities\Reserve;
use Modules\Setting\Entities\Setting;

class PlaceDetailPage extends Component
{
    use CommentTrait;

    public $object;
    public $price;
    public $time;
    public $date;
    public $guest_count;
    public $type;

    public $is_Added_To_WishList = true;

    public $comments;

    public $title;
    public $body;
    public $star = 0;

    public $work_days = [];
    public $times = [];

    private function ValidateCommentData()
    {
        $this->validate([
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:300',
            'star' => 'numeric|max:5',
        ]);
    }

    public function SubmitNewComment()
    {
        self::CheckBadWords($this->title , $this->body);
        $this->ValidateCommentData();

        $this->star = $this->star !=0 ?  $this->star : null;

        auth()->user()->comments()->create([
            'commentable_id' => $this->object->id,
            'commentable_type' => get_class($this->object),
            'body' => $this->body,
            'title' => $this->title,
            'score' => $this->star
        ]);

        $this->title = $this->body = null;
        $this->star = 0;

        session()->flash('comment_add' , 'نظر شما کاربر عزیز با موفقیت ثبت شد و پس تایید مدیر در سایت قرار میگیرد.');
    }

    public function AddToWishList()
    {
        auth()->user()->wish_lists()->create([
            'wish_listable_id' => $this->object->id,
            'wish_listable_type' => get_class($this->object),
        ]);

        $this->is_Added_To_WishList = true;
    }

    public function DeleteFromWishList()
    {
        auth()->user()->wish_lists()
            ->where('wish_listable_id' , $this->object->id)
            ->where('wish_listable_type' , get_class($this->object))
            ->delete();

        $this->is_Added_To_WishList = false;
    }

    private function getTimes()
    {
        $work_time = $this->object->work_time;
        $start_hour = date('H', strtotime($work_time->start_time));
        $end_hour = date('H', strtotime($work_time->end_time));
        for ($i = $start_hour ; $i <= $end_hour ; $i++)
        {
            $this->times[] = $i;
        }
    }

    private function getData()
    {
        $this->comments = $this->object->comments()->where('status' , 'approved')->get();
        $this->work_days = $this->object->work_time ? explode(', '  , $this->object->work_time->week_days) : [];
        $this->object->work_time && $this->getTimes();
    }

    public function mount()
    {
        $this->object->increment('viewCount');

        if (auth()->check() && $this->object->wish_lists->where('user_id' , auth()->id())->isEmpty())
        {
            $this->is_Added_To_WishList = false;
        }

        $this->price = Setting::getPriceFromSettings();
    }

    public function render()
    {
        $this->getData();
        $reserve_types = Reserve::GetTypes();
        return view('place::livewire.pages.front.place-detail-page', ['reserve_types' => $reserve_types]);
    }
}
