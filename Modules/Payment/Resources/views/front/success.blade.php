@extends('layouts.front-master')
@section('titlePage','پرداخت موفق')
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
                    <h4>تراکنش با موفقیت انجام شد. پیامک حاوی اطلاعات تراکنش برای شما ارسال شد.</h4>
                    <p>{{ number_format($payment->amount ?: 0) }} تومان</p>
                    <h1 style="color: #fff !important;">شناسانه پیگیری: {{ $payment->refID ?: '---' }}</h1>
                </div>
            </div>
        </div>
    </div>

@endsection
