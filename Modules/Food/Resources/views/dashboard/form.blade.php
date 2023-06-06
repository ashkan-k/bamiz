@extends('layouts.admin-master')

@if(isset($food))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن غذا')
@endif

@section('content')
    @if(isset($food))
        @livewire("food::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش غذا',
        'type' => 'edit',
        'item' => $food

        ])
    @else

        @livewire("food::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن غذا جدید'

        ])
    @endif
@endsection
