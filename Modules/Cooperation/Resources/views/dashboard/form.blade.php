@extends('layouts.admin-master')

@if(isset($cooperation))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن درخواست همکاری')
@endif

@section('content')
    @if(isset($cooperation))
        @livewire("cooperation::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش درخواست همکاری',
        'type' => 'edit',
        'item' => $cooperation

        ])
    @else

        @livewire("cooperation::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن درخواست همکاری جدید'

        ])
    @endif
@endsection
