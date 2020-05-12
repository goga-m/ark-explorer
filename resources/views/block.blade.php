@extends('layout')

@section('content')
    @livewire('block-detail', ['blockId' => $id])
@endsection