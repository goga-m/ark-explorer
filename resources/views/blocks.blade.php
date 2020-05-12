@extends('layout')

@section('content')
    @livewire('blocks', ['page' => $page])
@endsection