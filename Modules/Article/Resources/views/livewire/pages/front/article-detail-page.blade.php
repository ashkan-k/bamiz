<div>
    <section class="hero_in general start_bg_zoom">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp animated"><span></span>جزییات مقاله {{ $object->title ?: '---' }}</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->

    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-12">
                <div class="bloglist singlepost">
                    <p><img alt="" class="img-fluid" src="{{ $object->get_image() }}"></p>
                    <h1>{{ $object->title ?: '---' }}</h1>
                    <div class="postmeta">
                        <ul>
                            <li>
                                <i style="font-family: FontAwesome !important;" class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($object->created_at)->diffForHumans() }}
                            </li>
                            <li><i style="font-family: FontAwesome !important;" class="fa fa-user"></i> {{ $object->user ? $object->user->fullname() : '---' }}</li>
                            <li><i style="font-family: FontAwesome !important;" class="fa fa-comment"></i> تعداد نظرات ({{ $comments->count() }})</li>
                        </ul>
                    </div>
                    <!-- /post meta -->
                    <div class="post-content">
                        <div class="dropcaps">
                            <p>{!! \Illuminate\Support\Str::limit($object->text, 150) !!}</p>
                        </div>

                        <p>{!! $object->text !!}</p>
                    </div>
                    <!-- /post -->
                </div>
                <!-- /single-post -->

                <hr>

                <div id="comments" style="margin-top: 90px !important;">
                    <h5>نظرات</h5>
                    <ul class="mt-3">
                        @if(!$comments->isEmpty())
                            @foreach($comments as $c)
                                <li>
                                    <div class="avatar col-md-3">
                                        <img width="70"
                                            src="{{ $c->user ? $c->user->get_avatar() : '---' }}"
                                            alt="{{ $c->user ? $c->user->fullname() : '---'  }}">
                                    </div>
                                    <div class="comment_right col-md-9 clearfix mt-3">
                                        <div class="comment_info">
                                            {{ \Carbon\Carbon::instance($c->created_at)->diffForHumans() }}  <span>  |  </span>توسط <span style="color: green">{{ $c->user->username }}</span>
                                        </div>
                                        <p class="mt-3">
                                            {{ $c->body ?: '---' }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach

                        @else
                            <h5>هنوز نظری وجود ندارد.</h5>
                        @endif
                    </ul>
                </div>

                <hr>

                <h5>شما نظری بگذارید</h5>

                @if($errors->any())

                    <div class="alert alert-danger text-center">

                        @foreach($errors->all() as $e)
                            {{ $e }}<br>
                        @endforeach

                    </div>

                @endif

                <form wire:submit.prevent="SubmitNewComment()">
                    <div class="form-group">
                        <input wire:model.defer="title" required type="text" name="title" class="form-control" placeholder="عنوان*">
                    </div>
                    <div class="form-group">
                        <select wire:model.defer="star" class="form-control" name="score">
                            <option value="" selected>امتیاز نمیدم (اختیاری)</option>
                            <option value="1">1 (ضعیف)</option>
                            <option value="2">2</option>
                            <option value="3">3 (متوسط)</option>
                            <option value="4">4</option>
                            <option value="5">5 (عالی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea wire:model.defer="body" required class="form-control" name="comments" id="comments2" rows="6"
                                  placeholder="متن نطر*"></textarea>
                    </div>

                    @if(session()->has('comment_add'))
                        <div class="mt-3 text-center text-success" style="font-size: 14px !important;">{{ session()->get('comment_add') }}</div>
                    @endif

                    <div class="form-group">
                        <button type="submit" id="submit2" class="btn_1 add_bottom_30"> ثبت نظر </button>
                    </div>
                </form>
            </div>
            <!-- /col -->

{{--            <aside class="col-lg-3">--}}

{{--                @include('livewire.front.components.blog_sidebar')--}}

{{--            </aside>--}}

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

@push('CSS')
    <link href="/front/css/blog.css" rel="stylesheet">
    <link href="/front/css/blog-rtl.css" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="/front/css/custom.css" rel="stylesheet">
@endpush
