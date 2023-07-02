<?php

namespace Modules\Article\Http\Livewire\Pages\Front;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Article\Entities\Article;
use Modules\Category\Entities\Category;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\Place\Entities\Place;

class ArticlesPage extends Component
{
    use WithPagination;

    public $pagination;
    public $search = '';

    protected $articles;
    protected $most_popular_articles;
    public $best_places;

    public function mount()
    {
        $this->search = request('search');
        $this->pagination = env('PAGINATION', 10);
    }

    public function SearchAndFilter()
    {
        // Empty Body just used for reloading page data
    }

    public function render()
    {
        $this->articles = Article::with(['user'])->whereStatus('publish')->Search($this->search)->latest();
        $this->most_popular_articles = Article::orderByDesc('like_count')->limit(3)->get();

        $data = [
            'articles' => $this->articles->paginate($this->pagination),
            'most_popular_articles' => $this->most_popular_articles,
        ];

        return view('article::livewire.pages.front.articles-page', $data);
    }
}
