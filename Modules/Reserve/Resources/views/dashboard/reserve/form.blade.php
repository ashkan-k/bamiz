@extends('layouts.admin-master')

@if(isset($reserf))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن رزرو')
@endif

@section('content')
    @if(isset($reserf))
        @livewire("reserve::pages.dashboard.reserve.form-page" , [

        'titlePage' => 'ویرایش رزرو',
        'type' => 'edit',
        'item' => $reserf

        ])
    @else

        @livewire("reserve::pages.dashboard.reserve.form-page" , [

        'titlePage' => 'افزودن رزرو جدید'

        ])
    @endif
@endsection
