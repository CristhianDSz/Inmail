@extends('layouts.master')

@section('pageTitle')
   Dependencias
@endsection

@section('content')
  @can('view', App\Dependency::class)
    <dependency-main></dependency-main>
  @else
    <p class="alert alert-warning tx-medium">Actualmente no tiene permisos para ver esta sección. Contacte al administrador para más información</p>
  @endcan
@endsection