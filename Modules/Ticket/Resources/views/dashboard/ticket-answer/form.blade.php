@extends('layouts.admin-master')

@if(isset($ticket))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن پاسخ تیکت')
@endif

@section('content')
    @if(isset($ticket))
        @livewire("ticket::pages.dashboard.ticket-answer.form-page" , [

        'titlePage' => 'ویرایش پاسخ تیکت',
        'type' => 'edit',
        'item' => $ticket

        ])
    @else
        @livewire("ticket::pages.dashboard.ticket-answer.form-page" , [

        'titlePage' => 'افزودن پاسخ تیکت جدید'

        ])
    @endif
@endsection
