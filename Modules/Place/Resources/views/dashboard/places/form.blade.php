@extends('layouts.admin-master')

@if(isset($place))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن مرکز')
@endif

@section('content')
    @if(isset($place))
        @livewire("place::pages.dashboard.place.form-page" , [

        'titlePage' => 'ویرایش مرکز',
        'type' => 'edit',
        'item' => $place

        ])
    @else

        @livewire("place::pages.dashboard.place.form-page" , [

        'titlePage' => 'افزودن مرکز جدید'

        ])
    @endif
@endsection
