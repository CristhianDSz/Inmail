@extends('layouts.master')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/multiselect/vue-multiselect.min.css') }}">
@endsection

@section('pageTitle')
   Terceros
@endsection


@section('content')
  <third-party-main></third-party-main>
@endsection