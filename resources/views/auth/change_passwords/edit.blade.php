@extends('layouts.master')

@section('pageTitle')
  Cambio de contraseña
@endsection

@section('content')
<div class="col-lg-2"></div>
        <div class="col-lg-8">
          @include('partials.errors')
          @include('partials.messages')

          <div class="card shadow-base bd-0">
            <div class="form-layout form-layout-4">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Cambiar contraseña</h6>
                <form method="POST" action="{{route('users.update',$user->id)}}">
                      @csrf
                      @method('PATCH')
                      <div class="row mg-b-10">
                          <label class="col-sm-5 form-control-label">Nombre completo: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                          <input type="text" name="name" class="form-control form-control-sm" placeholder="Nombre del usuario" value="{{$user->name}}">
                          </div>
                        </div><!-- row -->
                      <div class="row mg-b-10">
                          <label class="col-sm-5 form-control-label">Nombre de usuario: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                          <input type="text" name="username" class="form-control form-control-sm" placeholder="Usuario" value="{{$user->username }}">
                          </div>
                        </div><!-- row -->
                      <div class="row mg-b-10">
                          <label class="col-sm-5 form-control-label">Correo electrónico: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                          <input type="email" name="email" class="form-control form-control-sm" placeholder="Correo electrónico" value="{{$user->email }}">
                          </div>
                        </div><!-- row -->
                      <div class="row mg-b-10">
                          <label class="col-sm-5 form-control-label">Contraseña: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                          <input type="password" name="password" class="form-control form-control-sm" placeholder="Contraseña" value="{{$user->password }}">
                          </div>
                        </div><!-- row -->
                      <div class="row mg-b-10">
                          <label class="col-sm-5 form-control-label">Confirmar contraseña: <span class="tx-danger">*</span></label>
                          <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                          <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="Contraseña" value="{{$user->password}}">
                          </div>
                        </div><!-- row -->
                        <div class="form-layout-footer mg-t-30">
                          <button type="submit" class="btn btn-teal">Actualizar</button>
                        </div><!-- form-layout-footer -->
                   </form>
                  </div>
          </div><!-- card -->
        </div><!-- col-6 -->
@endsection