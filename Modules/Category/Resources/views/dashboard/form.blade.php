@extends('layouts.admin-master')

@if(isset($category))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن دسته بندی')
@endif

@section('content')
    @if(isset($category))
        @livewire("category::pages.dashboard.form-page" , [

        'titlePage' => 'ویرایش کابر',
        'type' => 'edit',
        'item' => $category

        ])
    @else

        @livewire("category::pages.dashboard.form-page" , [

        'titlePage' => 'افزودن دسته بندی جدید'

        ])
    @endif
@endsection
