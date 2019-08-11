@extends('layouts.master')

@section('pageTitle')
   Roles
@endsection

@section('content')
        <div class="col-lg-6">
          @include('partials.errors')
          @include('partials.messages')

          <div class="card shadow-base bd-0">
            <div class="form-layout form-layout-4">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Crear un nuevo rol</h6>
                    <p class="mg-b-30 tx-gray-600">Apartado destinado para la creación de roles</p>
                <form method="POST" action="{{route('roles.store')}}">
                      @csrf
                      <div class="row">
                          <label class="col-sm-4 form-control-label">Nombre del rol: <span class="tx-danger">*</span></label>
                          <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                          <input type="text" name="name" class="form-control" placeholder="Nombre del rol" value="{{old('name') }}">
                          </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Permisos: <span class="tx-danger">*</span></label>
                          <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="permissions[]" id="permissions" class="form-control select2"data-placeholder="Seleccione permisos" multiple>
                                    @foreach ($permissions as $permission)
                                  <option class="tx-bold" value="{{$permission->id}}">{{$permission->description}}</option>
                                    @endforeach
                                  </select>
                          </div>
                        </div>
                        <div class="form-layout-footer mg-t-30">
                          <button type="submit" class="btn btn-teal">Crear rol</button>
                        </div><!-- form-layout-footer -->
                   </form>
                  </div>
          </div><!-- card -->
        </div><!-- col-6 -->
        <div class="col-lg-6 mg-t-20 mg-lg-t-0">
          <div class="card shadow-base bd-0">
           
            <table class="table table-bordered tx-13 tx-gray-700">
                    <thead>
                      <tr class="bg-gray-100 tx-11 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Rol</th>
                        <th class="wd-60p">Permisos</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($roles as $role)
                      <tr>
                      <td><a href="{{route('roles.edit',$role->id)}}">{{$role->name}}</a></td>
                        <td>
                           <ul>
                            @foreach ($role->permissions as $permission)
                           <li>{{$permission->description}}</li>
                            @endforeach
                           </ul>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
          </div><!-- card -->
        </div><!-- col-6 -->
@endsection
