@extends('layouts.master')

@section('pageTitle')
   Edición de roles
@endsection

@section('content')
 <div class="row row-sm">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
      @include('partials.errors')
      @include('partials.messages')

      <div class="card shadow-base bd-0">
       @can('update', App\Role::class)
       <div class="form-layout form-layout-4">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Editar rol</h6>
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
                    <select name="permissions[]" id="permissions" class="form-control select2" multiple>
                    @foreach ($permissions as $permission)
                      <option class="tx-bold" value="{{$permission->id}}" 
                        {{($role->existentPermission($permission->id)) ? 'selected' : ''}}>{{$permission->description}}</option>
                        @endforeach
                      </select>
              </div>
            </div>
            <div class="form-layout-footer mg-t-30">
              <button type="submit" class="btn btn-teal">Guardar rol</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Regresar</a>
            </div><!-- form-layout-footer -->
       </form>
      </div>
       @endcan
      </div><!-- card -->
    </div><!-- col-6 -->
 </div>
@endsection
