@extends('layouts.admin-master')

@if(isset($item))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن کاربر')
@endif

@section('content')
    @if(isset($item))
        @livewire("user::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش کابر',
        'type' => 'edit',
        'item' => $item

        ])
    @else

        @livewire("user::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن کاربر جدید'

        ])
    @endif
@endsection
