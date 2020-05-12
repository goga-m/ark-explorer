@extends('layout')

@section('content')
    @livewire('transactions', ['page' => $page])
@endsection