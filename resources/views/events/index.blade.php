@extends('layouts.master')

@section('pageTitle')
   Bitácora de Eventos
@endsection

@section('content')
     <div class="row row-sm">
          <div class="col-lg-12 mg-t-20 mg-lg-t-0">
            @can('view', App\RecordEvent::class)
                @if (count($events))
                <div class="card shadow-base bd-0">
                  <div class="card-body">
                  <div class="d-flex justify-content-between"><div class="text-left"><small class="font-weight-bold">Total eventos: {{ count($events) ?? '0'}}</small></div>
                </div>
                    <table class="table tx-13 tx-gray-700 mt-2">
                            <tbody>
                            @if (count($events))
                                @foreach ($events as $event)
                              <tr>
                              <td>
                                  El usuario <span class="text-info font-weight-bold">{{$event->user->name}}</span> ha {{$event->action}} el registro con número <span class="font-weight-bold">{{$event->record}}</span> (de {{$event->record_type}})
                                  con estado de <span class="font-weight-bold">{{$event->record_status}}</span> el {{$event->created_at->format('d-m-Y')}} a las {{$event->created_at->format('h:i:s A')}}
                              </td>
                              </tr>
                              @endforeach
                            @endif
                            </tbody>
                          </table>
                    
                        <div class="d-flex justify-content-center">
                              {{ $events->links() }}
                        </div>
                    
                  </div>
                </div><!-- card -->
              @else
                <div class="alert alert-bordered alert-warning" role="alert">
                  <p class="text-center">
                    Actualmente no existen eventos registrados en la aplicación.
                  </p>
                </div>
              @endif
            @else
              <p class="alert alert-warning tx-medium">Actualmente no tiene permisos para ver esta sección. Contacte al administrador para más información</p>
            @endcan
          </div><!-- col-6 -->
     </div>
@endsection