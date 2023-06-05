<?php

namespace Modules\Article\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Article\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    use Responses, Uploader;

    public function index()
    {
        return view('article::dashboard.list');
    }

    public function create()
    {
        return view('article::dashboard.form');
    }

    public function store(ArticleRequest $request)
    {
        $image = $this->UploadFile($request, 'image', 'articles_images', $request->title);

        Article::create(array_merge($request->validated(), ['image' => $image]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'articles.index');
    }

    public function edit(Article $article)
    {
        return view('article::dashboard.form', compact('article'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $image = $this->UploadFile($request, 'image', 'articles_images', $article->title, $article->image);

        $article->update(array_merge($request->validated(), ['image' => $image]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'articles.index');
    }
}
