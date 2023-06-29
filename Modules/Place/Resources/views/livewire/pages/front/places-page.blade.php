<div>
    <section class="hero_in restaurants start_bg_zoom">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp animated"><span></span>Paris Eat &amp; Drink list</h1>
            </div>
        </div>
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
                            <option value="{{ $c->slug }}">{{ $c->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 search_button_mobile">
                    <input wire:click="render()" style="height: 40px !important; width: 100% !important;"
                           type="submit" class="btn_1" value="جستجو">
                </div>

                {{--                <div class="col-lg-2">--}}
                {{--                    <p class="text-center"><a href="#0" class="btn_1 rounded">جستجو</a></p>--}}
                {{--                </div>--}}
            </div>
            <!-- /row -->
        </div>

        <div class="wrapper-grid mt-5">
            <div class="row">

                @foreach($places as $place)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="box_grid" style="height: 504px !important;">
                            <figure>
                                @if(auth()->check())
                                    @if($place->wish_lists->where('user_id' , auth()->user()->id)->isEmpty())
                                        <a wire:click="AddToWishList('{{ $place->id }}')" class="wish_bt"></a>
                                    @else
                                        <a wire:click="DeleteFromWishList('{{ $place->id }}')"
                                           class="wish_bt liked"></a>
                                    @endif
                                @endif

                                <a href="/centers/{{ $place->slug }}"><img
                                        src="{{ $place->cover['images']['original'] }}" class="img-fluid" alt=""
                                        width="800" height="533">
                                    <div class="read_more"><span>مشاهده</span></div>
                                </a>

                                <small>{{ $place->category ? $place->category->title : '---' }}</small>
                            </figure>
                            <div class="wrapper" style="height: 170px !important;">
                                <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i
                                        class="icon_star"></i><i class="icon_star"></i></div>
                                <h3><a href="/centers/{{ $place->slug }}"> {{ \Illuminate\Support\Str::limit($place->name, 30) }} </a></h3>

                                <p>{!! \Illuminate\Support\Str::limit($place->description, 80) !!}</p>

                                {{--                                <span class="price">From <strong>$54</strong> /per person</span>--}}
                            </div>
                            <ul>
                                <li><i class="ti-eye"></i>{{ $place->viewCount }} بازدید</li>
                                <li>
                                    <div class="score">
                                        <strong>{{ $place->province ? $place->province->title : '---' }}</strong></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>

            {{ $places->onEachSide(3)->links('livewire.front_pagination') }}
        </div>

{{--        {!! $places->links() !!}--}}

    </div>
</div>

@section('Scripts')
    <script>
        // $('#id_city').select2();
    </script>
@endsection
