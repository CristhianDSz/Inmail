@extends('layouts.master')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/multiselect/vue-multiselect.min.css') }}">
@endsection

@section('pageTitle')
   Funcionarios
@endsection


@section('content')
  <employee-main></employee-main>
@endsection