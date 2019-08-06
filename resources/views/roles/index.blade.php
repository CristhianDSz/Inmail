@extends('layouts.master')

@section('pageTitle')
   Roles
@endsection

@section('content')
        <div class="col-lg-6">
          <div class="card shadow-base bd-0">
            <div class="form-layout form-layout-4">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Crear un nuevo rol</h6>
                    <p class="mg-b-30 tx-gray-600">Apartado destinado para la creación de roles</p>
                    <div class="row">
                      <label class="col-sm-4 form-control-label">Firstname: <span class="tx-danger">*</span></label>
                      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" placeholder="Enter firstname">
                      </div>
                    </div><!-- row -->
                    <div class="row mg-t-20">
                      <label class="col-sm-4 form-control-label">Lastname: <span class="tx-danger">*</span></label>
                      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" placeholder="Enter lastname">
                      </div>
                    </div>
                    <div class="row mg-t-20">
                      <label class="col-sm-4 form-control-label">Email: <span class="tx-danger">*</span></label>
                      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" placeholder="Enter email address">
                      </div>
                    </div>
                    <div class="row mg-t-20">
                      <label class="col-sm-4 form-control-label">Address: <span class="tx-danger">*</span></label>
                      <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <textarea rows="2" class="form-control" placeholder="Enter your address"></textarea>
                      </div>
                    </div>
                    <div class="form-layout-footer mg-t-30">
                      <button class="btn btn-info">Submit Form</button>
                      <button class="btn btn-secondary">Cancel</button>
                    </div><!-- form-layout-footer -->
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
                      <tr>
                        <td>Administrador</td>
                        <td>
                          <p><strong class="tx-11 tx-medium">TERCEROS:</strong><br>Crear | Actualizar | Eliminar </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil numquam doloremque voluptatem possimus culpa. Mollitia, repellendus a dolorum voluptas officiis, recusandae maiores molestiae, rerum aliquam vel possimus inventore natus. Consequuntur.</p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
          </div><!-- card -->
        </div><!-- col-6 -->
@endsection