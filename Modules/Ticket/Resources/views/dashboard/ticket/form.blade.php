@extends('layouts.admin-master')

@if(isset($ticket))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن تیکت')
@endif

@section('content')
    @if(isset($ticket))
        @livewire("ticket::pages.dashboard.ticket.form-page" , [

        'titlePage' => 'ویرایش تیکت',
        'type' => 'edit',
        'item' => $ticket

        ])
    @else
        @livewire("ticket::pages.dashboard.ticket.form-page" , [

        'titlePage' => 'افزودن تیکت جدید'

        ])
    @endif
@endsection
