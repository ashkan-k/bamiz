<div>
    <section class="hero_in restaurants start_bg_zoom">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp animated"><span></span>{{ $titlePage }}</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->

    <div class="container margin_60_35">
        <div class="wrapper-grid mt-5">
            <div class="row">

                @if(!$places->isEmpty())
                    @foreach($places as $place)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="box_grid" style="height: 504px !important;">
                                <figure>
                                    <a wire:click="DeleteFromWishList('{{ $place->id }}')"
                                       class="wish_bt liked"></a>

                                    <a href="{{ route('place_detail', $place->slug) }}"><img
                                            src="{{ $place->cover['images']['original'] }}" class="img-fluid" alt=""
                                            width="800" height="533">
                                        <div class="read_more"><span>مشاهده</span></div>
                                    </a>

                                    <small>{{ $place->category ? $place->category->title : '---' }}</small>
                                </figure>
                                <div class="wrapper" style="height: 170px !important;">
                                    <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i
                                            class="icon_star"></i><i class="icon_star"></i></div>
                                    <h3>
                                        <a href="{{ route('place_detail', $place->slug) }}"> {{ \Illuminate\Support\Str::limit($place->name, 30) }} </a>
                                    </h3>

                                    <p>{!! \Illuminate\Support\Str::limit($place->description, 30) !!}</p>
                                </div>
                                <ul>
                                    <li><i class="ti-eye"></i>{{ $place->viewCount }} بازدید</li>
                                    <li>
                                        <div class="score">
                                            <strong>{{ $place->province ? $place->province->title : '---' }}</strong>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

            @if($places->isEmpty())
                <h5 class="text-center">موردی یافت نشد.</h5>
            @endif

            {{ $places->onEachSide(3)->links('livewire.front_pagination') }}
        </div>
    </div>
</div>

