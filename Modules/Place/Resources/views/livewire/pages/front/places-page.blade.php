<div>
    <!-- I am here now -->
    <section class="hero_in restaurants start_bg_zoom"> 
        <div class="wrapper" style="background: url('public\front\img\intro_gif.gif'); width: 100% !important;   background-size: cover !important; background-repeat: no-repeat !important;">
            <div class="container">
                <h1 class="fadeInUp animated"><span></span>{{ $titlePage }}</h1>
            </div>
        </div>
<!-- 
        <div class="wrapper" style="background: url('@if(isset($category_object)) {{ $category_object->get_banner() }} @else {{ $settings['banner_image'] }} @endif'); width: 100% !important;   background-size: cover !important; background-repeat: no-repeat !important;">
            <div class="container">
                <h1 class="fadeInUp animated"><span></span>{{ $titlePage }}</h1>
            </div>
        </div> -->
        
    </section>
    <!--/hero_in-->

    <div class="collapse" id="collapseMap">
        <div id="map" class="map"></div>
    </div>
    <!-- End Map -->

    <div class="container margin_60_35">
        <div class="col-lg-12">
            <div class="row no-gutters inner">
                <div class="col-lg-4">
                    <div class="form-group">
                        <input wire:model.defer="search" class="form-control" type="text"
                               placeholder="دنبال چه چیزی میگردید...؟">
                    </div>
                </div>

                <div class="col-lg-3">
                    <select wire:model.defer="city" id="id_city" class="form-control" style="alignment: right">
                        <option value="">همه شهر ها</option>
                        @foreach($cities as $c)
                            <option value="{{ $c->id }}">{{ $c->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3">
                    <select wire:model.defer="category" class="form-control" style="alignment: right">
                        <option value="">همه دسته بندی ها</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 search_button_mobile">
                    <input wire:click="SearchAndFilter()" style="height: 40px !important; width: 100% !important;"
                           type="submit" class="btn_1" value="جستجو">
                </div>
            </div>
            <!-- /row -->
        </div>

        <div class="wrapper-grid mt-5">
            <div class="row">

                @if(!$places->isEmpty())
                    @foreach($places as $place)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="box_grid"
{{--                                 style="height: 504px !important;"--}}
                            >
                                <figure>
                                    @if(auth()->check())
                                        @if($place->wish_lists->where('user_id' , auth()->user()->id)->isEmpty())
                                            <a wire:click="AddToWishList('{{ $place->id }}')" class="wish_bt"></a>
                                        @else
                                            <a wire:click="DeleteFromWishList('{{ $place->id }}')"
                                               class="wish_bt liked"></a>
                                        @endif
                                    @endif

                                    <a href="{{ route('place_detail', $place->slug) }}"><img
                                            src="{{ $place->cover['images']['original'] }}" class="img-fluid" alt=""
                                            width="800" height="533">
                                        <div class="read_more"><span>مشاهده</span></div>
                                    </a>

                                    <small>{{ $place->category ? $place->category->title : '---' }}</small>
                                </figure>
                                <div class="wrapper" style="height: 110px !important;">
                                    <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i
                                            class="icon_star"></i><i class="icon_star"></i></div>
                                    <h3>
                                        <a href="{{ route('place_detail', $place->slug) }}"> {{ \Illuminate\Support\Str::limit($place->name, 30) }} </a>
                                    </h3>

                                    <p>{!! \Illuminate\Support\Str::limit($place->description, 30) !!}</p>

                                    {{--                                <span class="price">From <strong>$54</strong> /per person</span>--}}
                                </div>
                                <ul>
                                    <li><i class="ti-eye"></i>{{ $place->viewCount }} بازدید</li>

                                    @if($place->food_discount && $place->options()->where('discount_amount', '>', 0)->exists())

                                        @if($place->type == 'hotel')

                                            <li>
                                                <div class="score">
                                                    <strong> تخفیف تشریفات و اتاق ({{$place->food_discount}}%)</strong>
                                                </div>
                                            </li>

                                        @else

                                            <li>
                                                <div class="score">
                                                    <strong>   تخفیف تشریفات و غذا ({{$place->food_discount}}%)</strong>
                                                </div>
                                            </li>

                                        @endif

                                    @elseif($place->food_discount)

                                        @if($place->type == 'hotel')

                                            <li>
                                                <div class="score">
                                                    <strong> تخفیف اتاق ({{$place->food_discount}}%)</strong>
                                                </div>
                                            </li>

                                        @else

                                            <li>
                                                <div class="score">
                                                    <strong> تخفیف غذا ({{$place->food_discount}}%)</strong>
                                                </div>
                                            </li>

                                        @endif

                                    @else

                                        <li>
                                            <div class="score">
{{--                                                <strong>تخفیف تشریفات</strong>--}}
                                            </div>
                                        </li>

                                    @endif

{{--                                    <li>--}}
{{--                                        <div class="score">--}}
{{--                                            <strong>{{ $place->province ? $place->province->title : '---' }}</strong>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
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

@section('Scripts')
    <script>
        // $('#id_city').select2();
    </script>
@endsection
