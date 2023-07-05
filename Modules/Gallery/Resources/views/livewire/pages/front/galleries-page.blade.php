<div>
    <main>

        <section class="hero_in restaurants start_bg_zoom">
            <div class="wrapper">
                <div class="container">
                </div>
            </div>
        </section>
        <!--/hero_in-->
        <!-- End Map -->

        <div class="margin_60_35"  style="margin: 20px 20px !important;">

            <div class="row">

                @foreach($galleries as $lg)

                    <div class="col-xl-3 col-lg-6 col-md-6" >
                        <a href="{{ $lg->get_image() }}" class="grid_item">
                            <figure>
                                <div class="score"><strong>5</strong></div>
                                <img src="{{ $lg->get_image() }}" class="img-fluid" alt="{{ $lg->place ? $lg->place->name : '---' }}"
                                     style="height:200px;width:400px">
                                <div class="info">
                                    <h3>مرکز {{ $lg->place ? $lg->place->name : '---' }}</h3>
                                </div>
                            </figure>
                        </a>
                    </div>

                @endforeach

            </div>

            {{ $galleries->onEachSide(3)->links('livewire.front_pagination') }}

        </div>


        <!-- /container -->
    </main>
</div>
