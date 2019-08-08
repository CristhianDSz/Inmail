@extends('layouts.master')

@section('pageTitle')
   Usuarios
@endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/multiselect/select2.min.css')}}">
    
@endsection

@section('content')
        <div class="col-lg-6">
          @include('partials.errors')
          @include('partials.messages')

          <div class="card shadow-base bd-0">
            <div class="form-layout form-layout-4">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Crear un nuevo Usuario</h6>
                    <p class="mg-b-30 tx-gray-600">Apartado destinado para la creación de usuarios</p>
                <form method="POST" action="{{route('users.store')}}">
                      @csrf
                      <div class="row mg-b-10">
                          <label class="col-sm-5 form-control-label">Nombre completo: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                          <input type="text" name="name" class="form-control form-control-sm" placeholder="Nombre del usuario" value="{{old('name') }}">
                          </div>
                        </div><!-- row -->
                      <div class="row mg-b-10">
                          <label class="col-sm-5 form-control-label">Nombre de usuario: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                          <input type="text" name="username" class="form-control form-control-sm" placeholder="Usuario" value="{{old('username') }}">
                          </div>
                        </div><!-- row -->
                      <div class="row mg-b-10">
                          <label class="col-sm-5 form-control-label">Correo electrónico: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                          <input type="email" name="email" class="form-control form-control-sm" placeholder="Correo electrónico" value="{{old('email') }}">
                          </div>
                        </div><!-- row -->
                      <div class="row mg-b-10">
                          <label class="col-sm-5 form-control-label">Contraseña: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                          <input type="password" name="password" class="form-control form-control-sm" placeholder="Contraseña" value="{{old('name') }}">
                          </div>
                        </div><!-- row -->
                      <div class="row mg-b-10">
                          <label class="col-sm-5 form-control-label">Confirmar contraseña: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                          <input type="password" name="password_confirm" class="form-control form-control-sm" placeholder="Contraseña" value="{{old('password_confirm') }}">
                          </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-5 form-control-label">Roles: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <select name="roles[]" id="roles" class="form-control form-control-sm select-roles" multiple>
                                    @foreach ($roles as $role)
                                  <option class="tx-bold" value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                  </select>
                          </div>
                        </div>
                        <div class="form-layout-footer mg-t-30">
                          <button type="submit" class="btn btn-info">Crear usuario</button>
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
                        <th class="wd-40p">Usuarios</th>
                        <th class="wd-60p">Roles</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- @foreach ($roles as $role)
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
                      @endforeach --}}
                    </tbody>
                  </table>
          </div><!-- card -->
        </div><!-- col-6 -->
@endsection

@section('scripts')
      <script src="{{asset('js/multiselect/select2.min.js')}}"></script>
      <script>
        $(document).ready(function () {
          $('.select-roles').select2({
            theme:'classic',

          })
        })
      </script>
@endsection