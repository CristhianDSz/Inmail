@extends('layouts.master')

@section('styles')
    @livewireStyles
@endsection

@section('pageTitle')
   Editar Sticker
@endsection

@section('content')
    @livewire('stickers.sticker',[ 'total' => $total, 'modelId' => $sticker->id])
@endsection

@section('scripts')
    @livewireScripts
@endsection