@extends('layouts.admin-master')

@if(isset($hotel_room))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن اتاق هتل')
@endif

@section('content')
    @if(isset($hotel_room))
        @livewire("place::pages.dashboard.hotel-room.form-page" , [

        'titlePage' => 'ویرایش اتاق هتل',
        'type' => 'edit',
        'item' => $hotel_room

        ])
    @else

        @livewire("place::pages.dashboard.hotel-room.form-page" , [

        'titlePage' => 'افزودن اتاق هتل جدید'

        ])
    @endif
@endsection
