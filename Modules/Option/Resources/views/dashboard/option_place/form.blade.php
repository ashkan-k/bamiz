@extends('layouts.admin-master')

@if(isset($option))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن تشریفات')
@endif

@section('content')
    @if(isset($option))
        @livewire("option::pages.dashboard.option_place.form-page" , [

        'titlePage' => 'ویرایش تشریفات',
        'type' => 'edit',
        'item' => $option

        ])
    @else

        @livewire("option::pages.dashboard.option_place.form-page" , [

        'titlePage' => 'افزودن تشریفات جدید'

        ])
    @endif
@endsection
