@extends('layouts.front-master')
@section('titlePage','پرداخت نا موفق')
@section('Styles')

@endsection
@section('Scripts')

@endsection
@section('content')

    <div class="hero_in cart_section last">
        <div class="wrapper">
            <div class="container">
                <div class="bs-wizard clearfix">
                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">انتخاب مرکز</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">فاکتور رزرو</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum">پرداخت</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a class="bs-wizard-dot"></a>
                    </div>
                </div>
                <!-- End bs-wizard -->
                <div id="confirm">
                    <h1 class="text-danger">تراکنش با خطا مواجه شد.</h1>
                    <p>در صورت کسر وجه از حساب بانکی شما، مبلغ ظرف 48 ساعت به حساب شما عودت داده خواهد شد.</p>
                    @if(isset($error_code))
                        <h2 style="color: #fff !important;">کد خطا: {{ $error_code ?: '---' }}</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
