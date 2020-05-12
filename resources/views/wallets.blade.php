@extends('layout')

@section('content')
    @livewire('wallets', ['page' => $page])
@endsection