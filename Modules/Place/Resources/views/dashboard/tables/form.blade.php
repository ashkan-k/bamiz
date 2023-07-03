@extends('layouts.admin-master')

@if(isset($table))
    @section('titlePage','ویرایش')
@else
    @section('titlePage','افزودن میز مرکز')
@endif

@section('content')
    @if(isset($table))
        @livewire("place::pages.dashboard.table.form-page" , [

        'titlePage' => 'ویرایش میز مرکز',
        'type' => 'edit',
        'item' => $table

        ])
    @else

        @livewire("place::pages.dashboard.table.form-page" , [

        'titlePage' => 'افزودن میز مرکز جدید'

        ])
    @endif
@endsection
