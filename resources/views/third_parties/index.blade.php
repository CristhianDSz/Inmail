@extends('layouts.master')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/multiselect/vue-multiselect.min.css') }}">
@endsection

@section('pageTitle')
   Terceros
@endsection

@section('content')

  @can('view', App\ThirdParty::class)
    <third-party-main></third-party-main>
  @else
    <p class="alert alert-warning tx-medium">Actualmente no tiene permisos para ver esta sección. Contacte al administrador para más información</p>
  @endcan
  
@endsection