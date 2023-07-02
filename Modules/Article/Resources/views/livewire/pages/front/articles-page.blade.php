<div>
    <section class="hero_in general">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>مقالات بامیز</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->

    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-9">

                @foreach($articles as $a)

                    <article class="blog wow fadeIn">
                        <div class="row no-gutters">
                            <div class="col-lg-7">
                                <figure>
                                    <a href="{{ route('article_detail', $a->slug) }}"><img src="{{ $a->get_image() }}"
                                                                         alt="{{ $a->title }}">
                                        <div class="preview"><span>مشاهده</span></div>
                                    </a>
                                </figure>
                            </div>
                            <div class="col-lg-5">
                                <div class="post_info">
                                    <small>{{ \Carbon\Carbon::parse($a->created_at)->diffForHumans() }}</small>
                                    <br><br>
                                    <h3>
                                        <a href="{{ route('article_detail', $a->slug) }}">{{ \Illuminate\Support\Str::limit($a->title, 50) }}</a>
                                    </h3>
                                    <p>{!! \Illuminate\Support\Str::limit($a->text, 150) !!}</p>
                                    <ul>
                                        <li>
                                            <div class="thumb">
                                                <img
                                                    src="{{ $a->user ? $a->user->get_avatar() : '---' }}"
                                                    alt="">
                                            </div> {{ $a->user ? $a->user->fullname() : '---' }}
                                        </li>
                                        <li>
                                            <i style="font-family: FontAwesome !important;"
                                               class="fa fa-eye"></i> {{ $a->view_count }}
                                            &nbsp;
                                            <i style="font-family: FontAwesome !important;"
                                               class="fa fa-heart"></i> {{ $a->like_count }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                    <!-- /article -->

                @endforeach

                {{ $articles->onEachSide(3)->links('livewire.front_pagination') }}

            </div>
            <!-- /col -->

            <aside class="col-lg-3">
                <div class="widget">
                    <form>
                        <div class="form-group">
                            <input type="text" name="search" id="search" class="form-control"
                                   value="{{ request('search') }}"
                                   style="margin-bottom: -32px !important;    padding-left: 109px !important;"
                                   placeholder="جستجو...">
                            <button type="submit" id="submit" class="btn_1 badge-pill "
                                    style="margin-top: -10px !important;float: left;height: 41px;z-index: 1;position: relative; ">
                                جستجو
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /widget -->

                @include('livewire.front.components.blog_sidebar')

            </aside>
            <!-- /aside -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

@push('StackStyle')
    <link href="/front/css/blog.css" rel="stylesheet">
    <link href="/front/css/blog-rtl.css" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="/front/css/custom.css" rel="stylesheet">
@endpush
