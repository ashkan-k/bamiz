@extends('layouts.admin-master')

@if(isset($reserve_type))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن نوع رزرو')
@endif

@section('content')
    @if(isset($reserve_type))
        @livewire("reserve::pages.dashboard.reserve-type.form-page" , [

        'titlePage' => 'ویرایش نوع رزرو',
        'type' => 'edit',
        'item' => $reserve_type

        ])
    @else

        @livewire("reserve::pages.dashboard.reserve-type.form-page" , [

        'titlePage' => 'افزودن نوع رزرو جدید'

        ])
    @endif
@endsection
