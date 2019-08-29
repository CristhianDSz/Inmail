@extends('layouts.master')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/multiselect/vue-multiselect.min.css') }}">
@endsection

@section('pageTitle')
   Correspondencia
@endsection

@section('content')
   
   
  <record-main></record-main>
@endsection