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
        <!-- /custom-search-input-2 -->
        <div class="isotope-wrapper mt-3">

            @foreach($places as $place)

                <div class="box_list isotope-item popular">
                    <div class="row no-gutters">
                        <div class="col-lg-5" box_list isotope-item popular>
                            <figure>
                                <a href="/centers/{{ $place->slug }}"><img
                                        src="{{ $place->cover['images']['original'] }}" class="img-fluid" alt=""
                                        width="800" height="533">
                                    <div class="read_more"><span>مشاهده</span></div>
                                </a>
                            </figure>
                        </div>
                        <div class="col-lg-7">
                            <div class="wrapper">

                                @if(auth()->check())
                                    @if($place->wish_lists->where('user_id' , auth()->user()->id)->isEmpty())
                                        <a wire:click="AddToWishList('{{ $place->id }}')" class="wish_bt"></a>
                                    @else
                                        <a wire:click="DeleteFromWishList('{{ $place->id }}')"
                                           class="wish_bt liked"></a>
                                    @endif
                                @endif

                                <h3><a href="/centers/{{ $place->slug }}"> {{ $place->name }} </a></h3>
                                <p>{!! $place->description !!}</p>
                            </div>
                            <ul>
                                <li><i class="ti-eye"></i> {{ $place->viewCount }} بازدید</li>
                                <li>
                                    <div class="score">
                                        <strong>{{ $place->province ? $place->province->title : '---' }}</strong></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
        <!-- /isotope-wrapper -->

        {!! $places->links() !!}

        {{--        <p class="text-center"><a href="#0" class="btn_1 rounded">اینجا باید بیجینیت قرار بگیرد</a></p>--}}

    </div>
</div>

@section('Scripts')
    <script>
        // $('#id_city').select2();
    </script>
@endsection
