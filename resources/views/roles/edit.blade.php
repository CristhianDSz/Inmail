@extends('layouts.master')

@section('pageTitle')
   Roles
@endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/multiselect/select2.min.css')}}">
    
@endsection

@section('content')
        <div class="col-3"></div>
        <div class="col-lg-6">
          @include('partials.errors')
          @include('partials.messages')

          <div class="card shadow-base bd-0">
            <div class="form-layout form-layout-4">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Editar un rol</h6>
                    <p class="mg-b-30 tx-gray-600">Apartado destinado para la edición de roles</p>
                <form method="POST" action="{{route('roles.update',$role->id)}}">
                      @csrf
                      @method('PATCH')
                      <div class="row">
                          <label class="col-sm-4 form-control-label">Nombre del rol: <span class="tx-danger">*</span></label>
                          <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                          <input type="text" name="name" class="form-control" placeholder="Nombre del rol" value="{{$role->name}}">
                          </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label">Permisos: <span class="tx-danger">*</span></label>
                          <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="permissions[]" id="permissions" class="form-control select-roles" multiple>
                                @foreach ($permissions as $permission)
                                  <option class="tx-bold" value="{{$permission->id}}" 
                                    {{($role->existentPermission($permission->id)) ? 'selected' : ''}}>{{$permission->description}}</option>
                                    @endforeach
                                  </select>
                          </div>
                        </div>
                        <div class="form-layout-footer mg-t-30">
                          <button type="submit" class="btn btn-info">Guardar rol</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Regresar</a>
                        </div><!-- form-layout-footer -->
                   </form>
                  </div>
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