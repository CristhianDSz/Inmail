@extends('layouts.master')

@section('pageTitle')
Información de la empresa
@endsection

@section('content')
@if(!$company)
<div class="alert alert-bordered alert-info">
    <p class="tx-medium"><i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i> Actualmente no ha registrado la compañía, esto es importante para la operación de la aplicación, haga click en el siguiente enlace.</p>
    <a href="{{route('companies.create')}}" class="font-weight-bold"> <i class="icon ion-arrow-right-a tx-15"></i> Registrar la empresa</a>
</div>

@else
<div class="row row-sm">
    @can('view', App\Company::class)
    <div class="col-lg-9">
        <div class="br-section-wrapper br-sitemap-section pd-t-25">
            <div class="d-flex justify-content-end mg-0 pd-0">
                @can('update', App\Company::class)
                <a href="{{route('companies.edit',$company->id)}}">
                    <i class="icon ion-edit tx-teal tx-18"></i>
                </a>
                @endcan
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="tx-bold">Nombre de la empresa:</p>
                </div>
                <div class="col-md-6">
                    <p class="tx-medium">{{$company->name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="tx-bold">Nit/Cédula:</p>
                </div>
                <div class="col-md-6">
                    <p class="tx-medium">{{$company->identification}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="tx-bold">Correo electrónico:</p>
                </div>
                <div class="col-md-6">
                    <p class="tx-medium">{{$company->email}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="tx-bold">Dirección:</p>
                </div>
                <div class="col-md-6">
                    <p class="tx-medium">{{$company->address ?? 'No registrado'}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="tx-bold">Teléfono:</p>
                </div>
                <div class="col-md-6">
                    <p class="tx-medium">{{$company->phone ?? 'No registrado'}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="tx-bold">Empleados:</p>
                </div>
                <div class="col-md-6">
                    <p class="tx-medium">{{$employees}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="tx-bold">Dependencias:</p>
                </div>
                <div class="col-md-6">
                    <p class="tx-medium">{{$dependencies}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="tx-bold">Logo empresa:</p>
                </div>
                <div class="col-md-6">
                    @if($company->logo)
                    <img class="wd-150 mg-b-20" src="{{asset('storage/'.$company->logo)}}" alt="Logo empresa">
                    @else
                    <p class="tx-bold">No registrado</p>
                    @endif
                    <a href="{{ route('stickers.index') }}">Crear sticker</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="tx-bold">
                        Logo sticker impresión:
                    </p>
                </div>
                <div class="col-md-6">
                    @if($company->print_logo)
                    <img class="wd-150" src="{{asset('storage/'.$company->print_logo)}}" alt="Logo sticker">
                    @else
                    <p class="tx-bold">No registrado</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>
@endif

@endsection
