@extends('layouts.master')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/multiselect/vue-multiselect.min.css') }}">
@endsection

@section('pageTitle')
   Funcionarios
@endsection

@section('content')
  @can('view', App\Dependency::class)
    <employee-main></employee-main>
  @else
    <p class="alert alert-warning tx-medium">Actualmente no tiene permisos para ver esta sección. Contacte al administrador para más información</p>
  @endcan
@endsection