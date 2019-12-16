@extends('layouts.master')

@section('pageTitle')
   Usuarios
@endsection

@section('content')
     <div class="row row-sm">
          @include('partials.messages')
          <div class="col-lg-12 mg-t-20 mg-lg-t-0">
            <div class="card shadow-base bd-0">
             
              <div class="card-body">
              <div class="d-flex justify-content-between"><div class="text-left"><small class="font-weight-bold">Total usuarios: {{ count($users) ?? '0'}}</small></div>
              
              @can('create', App\User::class)
                <div class="text-right"><small class="font-weight-bold">Crear nuevo usuario</small>
                <a href="{{route('users.create')}}" class="btn btn-info btn-icon rounded-circle mg-r-5 mg-b-10 bd-4"><div><i class="icon ion-plus"></i></div></a></div>
              @endcan
            </div>

                <table class="table tx-13 tx-gray-700 mt-2">
                        <thead>
                          <tr class="bg-gray-100 tx-11 tx-uppercase tx-gray-800">
                            <th>Nombre</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Roles</th>
                            <th class="text-center">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                         @if (count($users))
                            @foreach ($users as $user)
                          <tr class="
                            {{$user->trashed() ? 'alert alert-bordered alert-warning' : ''}}">
                          <td>
                             {{$user->name}}
                          </td>
                          <td class="text-center">
                             {{$user->email}}
                          </td>
                          <td class="text-center">
                             {{$user->username}}
                          </td>
                            <td class="text-center">
                               <ul>
                                @foreach ($user->roles as $role)
                               <li>{{$role->name}}</li>
                                @endforeach
                               </ul>
                              </td>
                            <td class="text-center">
                              @if ($user->trashed())
                                @can('update', $user)
                                  <form action="{{route('users.restore.user', $user->id) }}" 
                                  method="post" 
                                  style="display:inline">
                                  @csrf
                                  @method('PATCH')
                                  <button type="submit" 
                                  style="border:none;background:none;cursor:pointer"
                                  title="Habilitar">
                                    <i class="icon ion-ios-checkmark tx-24 p-2 tx-warning"></i>
                                  </button>
                                  </form>
                                @endcan
                              @else
                                
                                @can('update', $user)
                                   <a href="{{ route('users.edit', $user->id) }}"><i class="icon ion-edit tx-22 p-2 tx-teal"></i></a>
                                @endcan

                               @can('delete', $user)
                                  <form action="{{route('users.destroy', $user->id) }}" 
                                  method="post" 
                                  style="display:inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" 
                                  style="border:none;background:none;cursor:pointer"
                                  onclick="event.preventDefault; confirm('¿Está seguro de realizar esta acción?')" title="Deshabilitar">
                                    <i class="icon ion-ios-minus tx-22 p-2 tx-teal"></i>
                                  </button>
                                </form>
                               @endcan
                              @endif
                              </td>
                            </tr>
                          @endforeach
                         @endif
                        </tbody>
                      </table>
              </div>
            </div><!-- card -->
          </div><!-- col-6 -->
     </div>
@endsection