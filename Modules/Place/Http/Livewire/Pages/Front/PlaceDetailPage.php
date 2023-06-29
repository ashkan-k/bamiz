<?php

namespace Modules\Place\Http\Livewire\Pages\Front;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Category\Entities\Category;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\Place\Entities\Place;
use Modules\Setting\Entities\Setting;

class PlaceDetailPage extends Component
{
    use ReserveTrait;
    use CommentTrait;

    public $place;
    public $price;
    public $time;
    public $date;
    public $guest_count;
    public $place_id;
    public $chair_id = [];

    public $is_Added_To_WishList = true;

    public $comments;

    public $title;
    public $body;
    public $star = 0;


    public $chairs = [];
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
            'commentable_id' => $this->place_id,
            'status' => false,
            'score' => $this->star,
            'commentable_type' => get_class($this->place)
        ]);

        $this->title = $this->body = null;
        $this->star = 0;

        session()->flash('comment_add' , 'نظر شما کاربر عزیز با موفقیت ثبت شد و پس تایید مدیر در سایت قرار میگیرد.');
    }

    public function AddToWishList()
    {
        auth()->user()->wish_lists()->create([
            'wish_listable_id' => $this->place_id,
            'wish_listable_type' => get_class($this->place),
        ]);

        $this->is_Added_To_WishList = true;
        session()->flash('wishlist_status' , 'با موفقیت به علاقه مندی ها افزوده شد');
    }

    public function DeleteFromWishList()
    {
        auth()->user()->wish_lists()
            ->where('wish_listable_id' , $this->place->id)->where('wish_listable_type' , get_class($this->place))->delete();

        $this->is_Added_To_WishList = false;
        session()->flash('wishlist_status' , 'با موفقیت از علاقه مندی ها حذف شد');
    }

    private function getTimes()
    {
        $work_time = $this->place->work_time;
        for ($i = $work_time->fromHour ; $i <= $work_time->toHour ; $i++)
        {
            $this->times[$i] = $i;
        }
    }

    private function getData()
    {
        $this->comments = Comment::where(function ($query){
            return $query->where('status' , 1)
                ->where('commentable_id' , $this->place->id)
                ->where('commentable_type' , get_class($this->place));
        })->get();
        $this->work_days = explode(' , '  , $this->place->work_time->week_days);
        $this->getTimes();
    }

    public function updated()
    {
        if (isset($this->time) && isset($this->date) && isset($this->place->id))
        {
            $this->ShowChairs();
        }
    }

    public function mount()
    {
        $this->place = Place::where('slug' , request('slug'))->firstOrFail();
        $this->place->increament('viewCount');

        if (auth()->check() && $this->place->wish_lists->where('user_id' , auth()->user()->id)->isEmpty())
        {
            $this->is_Added_To_WishList = false;
        }

        $this->price = Setting::getPriceFromSettings();
        $this->place_id = $this->place->id;
    }

    public function render()
    {
        $this->getData();
        return view('livewire.front.place-detail');
    }

    public function render()
    {
        $this->places = Place::with(['province', 'category'])->Search($this->search)->with(['wish_lists'])->latest();
        $this->FilterByCategory();
        $this->FilterByCity();

        $data = [
            'places' => $this->places->paginate($this->pagination),
            'categories' => Category::all(),
            'cities' => City::all(),
        ];
        return view('place::livewire.pages.front.places-page', $data);
    }
}
