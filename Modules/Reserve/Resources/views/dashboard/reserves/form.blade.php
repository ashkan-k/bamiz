@extends('layouts.admin-master')

@if(isset($reserve))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن رزرو')
@endif

@section('content')
    @if(isset($reserve))
        @livewire("reserve::pages.dashboard.reserve.form-page" , [

        'titlePage' => 'ویرایش رزرو',
        'type' => 'edit',
        'item' => $reserve

        ])
    @else

        @livewire("reserve::pages.dashboard.reserve.form-page" , [

        'titlePage' => 'افزودن رزرو جدید'

        ])
    @endif
@endsection
