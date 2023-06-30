<?php

namespace Modules\Place\Http\Livewire\Pages\Front;

use App\Http\Traits\CommentTrait;
use Livewire\Component;
use Modules\Comment\Entities\Comment;
use Modules\Setting\Entities\Setting;

class PlaceDetailPage extends Component
{
    use CommentTrait;

    public $object;
    public $price;
    public $time;
    public $date;
    public $guest_count;

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
            'title' => $this->title,
            'body' => $this->body,
            'commentable_id' => $this->object->id,
            'status' => false,
            'score' => $this->star,
            'commentable_type' => get_class($this->object)
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
        session()->flash('wishlist_status' , 'با موفقیت به علاقه مندی ها افزوده شد');
    }

    public function DeleteFromWishList()
    {
        auth()->user()->wish_lists()
            ->where('wish_listable_id' , $this->object->id)
            ->where('wish_listable_type' , get_class($this->object))
            ->delete();

        $this->is_Added_To_WishList = false;
        session()->flash('wishlist_status' , 'با موفقیت از علاقه مندی ها حذف شد');
    }

    private function getTimes()
    {
        $work_time = $this->object->work_time;
        for ($i = $work_time->start_time ; $i <= $work_time->end_time ; $i++)
        {
            $this->times[$i] = $i;
        }
    }

    private function getData()
    {
        $this->comments = Comment::where(function ($query){
            return $query->where('status' , 'approved')
                ->where('commentable_id' , $this->object->id)
                ->where('commentable_type' , get_class($this->object));
        })->get();
        $this->work_days = explode(', '  , $this->object->work_time->week_days);
        $this->getTimes();
    }

//    public function updated()
//    {
//        if (isset($this->time) && isset($this->date) && isset($this->>object->id))
//        {
//            $this->ShowChairs();
//        }
//    }

    public function mount()
    {
        $this->object->increment('viewCount');

        if (auth()->check() && $this->object->wish_lists->where('user_id' , auth()->user()->id)->isEmpty())
        {
            $this->is_Added_To_WishList = false;
        }

        $this->price = Setting::getPriceFromSettings();
    }

    public function render()
    {
        $this->getData();
        return view('place::livewire.pages.front.place-detail-page');
    }

//    public function render()
//    {
//        $this->>objects = Place::with(['province', 'category'])->Search($this->search)->with(['wish_lists'])->latest();
//        $this->FilterByCategory();
//        $this->FilterByCity();
//
//        $data = [
//            'places' => $this->>objects->paginate($this->pagination),
//            'categories' => Category::all(),
//            'cities' => City::all(),
//        ];
//        return view('place::livewire.pages.front.places-page', $data);
//    }
}
