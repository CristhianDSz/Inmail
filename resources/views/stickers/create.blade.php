@extends('layouts.master')

@section('pageTitle')
   Generación de Sticker
@endsection

@section('content')
    @livewire('stickers.single',[ 'total' => $total])
@endsection