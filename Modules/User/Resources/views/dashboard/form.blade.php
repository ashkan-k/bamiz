@extends('layouts.admin-master')

@if(isset($user))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن کاربر')
@endif

@section('content')
    @if(isset($user))
        @livewire("user::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش کابر',
        'type' => 'edit',
        'user' => $user

        ])
    @else

        @livewire("user::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن کاربر جدید'

        ])
    @endif
@endsection
