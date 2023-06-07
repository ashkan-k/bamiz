@extends('layouts.admin-master')

@if(isset($ticket_category))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن دسته بندی تیکت')
@endif

@section('content')
    @if(isset($ticket_category))
        @livewire("ticket::pages.dashboard.ticket-category.form-page" , [

        'titlePage' => 'ویرایش دسته بندی تیکت',
        'type' => 'edit',
        'item' => $ticket_category

        ])
    @else
        @livewire("ticket::pages.dashboard.ticket-category.form-page" , [

        'titlePage' => 'افزودن دسته بندی تیکت جدید'

        ])
    @endif
@endsection
