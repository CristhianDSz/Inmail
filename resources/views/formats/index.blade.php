@extends('layouts.master')

@section('pageTitle')
   Formatos
@endsection


@section('content')
 <div class="row row-sm">
    <div class="col-lg-10">
        <div class="card bd-0 shadow-base pd-30">
            <div class="d-flex align-items-center justify-content-between mg-b-30">
              <div>
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Filtrar por fecha</h6>
                <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i>{{$firstDate}} -  {{$secondDate}}</p>
              </div>
            <a title="Generar planilla" href="{{route('formats.pdf',['first_date' => $firstDate,'second_date'=> $secondDate])}}"><i class="icon ion-clipboard tx-32 tx-teal"></i></a>
            </div><!-- d-flex -->
            
          <form class="row mg-b-20" method="GET" action="{{route('formats.index')}}">
            <input class="form-control form-control-sm mg-r-5 col-4" type="date" name="first_date" value="{{$firstDate}}">
            <input class="form-control form-control-sm mg-l-5  col-4" type="date" name="second_date" value="{{$secondDate}}">
                <button type="submit" class="btn btn-outline-teal tx-11 tx-uppercase tx-medium tx-spacing-1 pd-x-30 mg-l-10 bd-2 col-2">Filtrar</button>
            </form>
    
           
    
            <table class="table table-responsive table-valign-middle mg-b-0">
              <thead>
                  <tr>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Número de radicado</th>
                      <th class="text-center">Remitente</th>
                      <th class="text-center">Descripción</th>
                      <th class="text-center">Destinatario</th>
                  </tr>
              </thead>
              <tbody>
               @forelse ($todayRecords as $record)
                <tr>
                  <td class="pd-l-0-force text-center">
                  <span class="tx-medium">{{$record->format_datetime}}</span>
                  </td>
                  <td class="pd-l-0-force text-center">
                  <span class="tx-medium">{{$record->number}}</span>
                  </td>
                  <td class="text-center">
                  <h6 class="tx-inverse tx-14 mg-b-0">{{$record->thirdParty->name}}</h6>
                  <span class="tx-12">{{$record->thirdParty->email_contact}}</span>
                  </td>
                <td class="text-center"><span class="tx-medium">{{$record->description}}</span></td>
                <td class="text-center"><span class="tx-medium">{{$record->employee->fullname}}</span></td>
                 
                </tr>
               @empty
                   <p class="tx-semibold">No se encuentran registros actualmente</p>
               @endforelse
              </tbody>
            </table>
          </div>
      </div>
 </div>
@endsection