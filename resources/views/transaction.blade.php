@extends('layout')

@section('content')
    @livewire('transaction-detail', ['txId' => $id])
@endsection