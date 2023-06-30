@extends('layouts.admin-master')

@if(isset($worktime))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن زمان کاری')
@endif

@section('content')
    @if(isset($worktime))
        @livewire("worktime::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش زمان کاری',
        'type' => 'edit',
        'item' => $worktime

        ])
    @else

        @livewire("worktime::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن زمان کاری جدید'

        ])
    @endif
@endsection
