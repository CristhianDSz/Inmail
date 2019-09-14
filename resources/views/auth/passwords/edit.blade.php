@extends('layouts.master')

@section('pageTitle')
  Cambio de Contraseña
@endsection

@section('content')
<div class="row row-sm">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
      @include('partials.errors')
      @include('partials.messages')

      <div class="card shadow-base bd-0">
        <div class="form-layout form-layout-4">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Actualizar Contraseña</h6>
            <form method="POST" action="{{route('users.update.password',auth()->user()->id)}}">
                  @csrf
                  @method('PATCH')

                  <div class="row mg-b-10">
                    <label class="col-sm-5 form-control-label">Contraseña: <span class="tx-danger">*</span></label>
                    <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                    <input type="password" name="password" class="form-control form-control-sm" placeholder="Contraseña" value="{{old('password')}}">
                    </div>
                  </div><!-- row -->
                <div class="row mg-b-10">
                    <label class="col-sm-5 form-control-label">Confirmar contraseña: <span class="tx-danger">*</span></label>
                    <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                    <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="Contraseña">
                    </div>
                  </div><!-- row -->
                  
                    <div class="form-layout-footer mg-t-30">
                      <button type="submit" class="btn btn-teal">Guardar cambios</button>
                    <a href="/app/correspondence" class="btn btn-secondary">Regresar al inicio</a>
                    </div><!-- form-layout-footer -->
               </form>
              </div>
      </div><!-- card -->
    </div><!-- col-6 -->
</div>
@endsection