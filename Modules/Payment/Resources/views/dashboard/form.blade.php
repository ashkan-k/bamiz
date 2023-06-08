@extends('layouts.admin-master')

@if(isset($payment))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن تراکنش')
@endif

@section('content')
    @if(isset($payment))
        @livewire("payment::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش تراکنش',
        'type' => 'edit',
        'item' => $payment

        ])
    @else
        @livewire("payment::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن تراکنش جدید'

        ])
    @endif
@endsection
