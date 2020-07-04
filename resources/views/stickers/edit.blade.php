@extends('layouts.master')

@section('styles')
    @livewireStyles
@endsection

@section('pageTitle')
   Editar Sticker
@endsection

@section('content')
    @livewire('stickers.single',[ 'total' => $total, 'modelId' => $sticker->id])
@endsection

@section('scripts')
    @livewireScripts
@endsection