@extends('layout')

@section('content')
    @livewire('wallet-detail', [ 'page' => $page, 'walletAddress' => $walletAddress, 'transactionType' => $transactionType ])
@endsection