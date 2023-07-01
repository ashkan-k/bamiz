<?php

namespace Modules\Article\Http\Livewire\Pages\Front;

use App\Http\Traits\CommentTrait;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Article\Entities\Article;
use Modules\Category\Entities\Category;
use Modules\Comment\Entities\Comment;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\Place\Entities\Place;

class ArticleDetailPage extends Component
{
    use CommentTrait;

    public $object;
    public $most_popular_articles = [];

    public $title;
    public $body;
    public $star = 0;

    private function ValidateCommentData()
    {
        $this->validate([
            'title' => 'required|string|max:50',
            'body' => 'required|string',
            'star' => 'nullable|numeric|max:5',
        ]);
    }

    public function SubmitNewComment()
    {
        $this->ValidateCommentData();
        self::CheckBadWords($this->title, $this->body);

        $this->star = $this->star != null ? $this->star : null;

        auth()->user()->comments()->create([
            'commentable_id' => $this->object->id,
            'commentable_type' => get_class($this->object),
            'body' => $this->body,
            'title' => $this->title,
            'score' => $this->star
        ]);

        $this->title = $this->body = null;
        $this->star = 0;

        session()->flash('comment_add', 'نظر شما کاربر عزیز با موفقیت ثبت شد و پس تایید مدیر در سایت قرار میگیرد.');
    }

    public function mount()
    {
        $this->object->increment('view_count');
    }

    public function render()
    {
//        $this->most_popular_articles = Article::orderByDesc('like_count')->limit(3)->get();

        $comments = $this->object->comments()->whereStatus('approved')->get();

        $data = [
            'most_popular_articles' => $this->most_popular_articles,
            'comments' => $comments,
        ];

        return view('article::livewire.pages.front.article-detail-page', $data);
    }
}
