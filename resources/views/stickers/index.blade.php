@extends('layouts.master')

@section('styles')
    @livewireStyles
@endsection

@section('pageTitle')
   Generación de Sticker
@endsection

@section('content')
    @livewire('stickers.sticker')
@endsection

@section('scripts')
    @livewireScripts
@endsection