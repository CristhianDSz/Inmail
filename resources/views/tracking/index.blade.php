@extends('layouts.master')

@section('pageTitle')
    Seguimientos de registros 
@endsection


@section('content')
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card bd-0 shadow-base pd-30 mg-t-20">
            <div class="d-flex align-items-center justify-content-between mg-b-30">
              <div>
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Por favor ingrese número de radicado:</h6>
              </div>
            </div><!-- d-flex -->
            
            @include('partials.errors')
            @include('partials.messages')

            @can('viewControl', App\Record::class)
              <form action="{{route('tracking.index')}}" method="GET">
                <div class="d-flex align-items-center justify-content-center bg-gray-100 ht-md-80 bd pd-x-20">
                    <div class="d-md-flex pd-y-20 pd-md-y-0">
                    <input type="text" name="record_ci" class="form-control" placeholder="Ingrese criterio de búsqueda" value="{{old('record_ci')}}">
                      <button class="btn btn-teal pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2">Buscar</button>
                    </div>
                </div>
              </form>
            @elsecan('viewAccounting', App\Record::class)
              <form action="{{route('tracking.index')}}" method="GET">
                <div class="d-flex align-items-center justify-content-center bg-gray-100 ht-md-80 bd pd-x-20">
                    <div class="d-md-flex pd-y-20 pd-md-y-0">
                    <input type="text" name="record_co" class="form-control" placeholder="Ingrese criterio de búsqueda" value="{{old('record_co')}}">
                      <button class="btn btn-teal pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2">Buscar</button>
                    </div>
                </div>
              </form>
            @endcan
        
           @if (count($records) > 0)
           <table class="table table-valign-middle mg-t-20">
             <thead>
               <tr>
                 <th class="text-center">Fecha de creación</th>
                 <th class="text-center">Radicado</th>
                 <th class="text-center">Remitente</th>
                 <th class="text-center">Número de factura</th>
                 <th class="text-center">Destinatario</th>
                 <th class="text-center">Descripción</th>
                 <th class="text-center"></th>
                 <th></th>
               </tr>
             </thead>
            <tbody>
              @foreach ($records as $record)
              <tr>
                <td class="tx-center">{{$record->format_date_time}}</td>
                <td class="pd-l-0-force tx-center tx-medium">
                  {{$record->number}}
                </td>
                <td class="pd-l-0-force tx-center tx-medium">
                  {{$record->thirdParty->name}}
                </td>
                <td class="pd-l-0-force tx-center tx-medium">
                  {{$record->invoice_number ?? 'No registra'}}
                </td>
                <td class="tx-center">
                <h6 class="tx-inverse tx-14 mg-b-0">{{$record->employee->fullname}}</h6>
                <span class="tx-12">{{$record->employee->dependency->name}}</span>
                </td>
                <td class="pd-l-0-force tx-center tx-medium">
                  {{$record->description}}
                  </td>
                <td class="pd-r-0-force">
                <form action="{{route('tracking.update',$record->id)}}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn btn-sm btn-warning">
                    <i class="icon ion-checkmark tx-15"></i>
                    </button>
                </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
           @else
            <p class="tx-semibold mg-t-10">No existen resultados actualmente.</p>
           @endif
          </div>
    </div>
</div>
@endsection