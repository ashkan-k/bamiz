@extends('layouts.admin-master')

@if(isset($worktime))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن زمان کاری')
@endif

@section('content')
    <?php $place = $place ?? null ?>

    @if(isset($worktime))
        @livewire("worktime::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش زمان کاری',
        'type' => 'edit',
        'item' => $worktime,
        'place' => $place,

        ])
    @else

        @livewire("worktime::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن زمان کاری جدید',
        'place' => $place,

        ])
    @endif
@endsection
