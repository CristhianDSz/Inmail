@extends('layouts.master')

@section('pageTitle')
   Permisos
@endsection

@section('content')
     
<div class="col-lg-12 mg-t-20 mg-lg-t-0">
          <div class="card shadow-base bd-0">
           
            <table class="table table-bordered tx-13 tx-gray-700">
                    <thead>
                      <tr class="bg-gray-100 tx-11 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Apartado</th>
                        <th class="wd-60p">Descripción y permisos</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Usuarios</td>
                        <td>
                         <p>Apartado compuesto por los siguientes permisos:</p>
                         <ul>
                           <li>Listar usuarios</li>
                           <li>Crear usuarios</li>
                           <li>Editar usuarios</li>
                           <li>Eliminar usuarios</li>
                         </ul>
                        </td>
                      </tr>
                      <tr>
                        <td>Terceros</td>
                        <td>
                         <p>Apartado compuesto por los siguientes permisos:</p>
                         <ul>
                            <li>Listar terceros</li>
                            <li>Crear terceros</li>
                            <li>Editar terceros</li>
                            <li>Eliminar terceros</li>
                          </ul>
                        </td>
                      </tr>
                      <tr>
                        <td>Dependencias</td>
                        <td>
                         <p>Apartado compuesto por los siguientes permisos:</p>
                         <ul>
                            <li>Listar dependencias</li>
                            <li>Crear dependencias</li>
                            <li>Editar dependencias</li>
                            <li>Eliminar dependencias</li>
                          </ul>
                        </td>
                      </tr>
                      <tr>
                        <td>Funcionarios</td>
                        <td>
                         <p>Apartado conformado por los siguientes permisos:</p>
                         <ul>
                            <li>Listar funcionarios</li>
                            <li>Crear funcionarios</li>
                            <li>Editar funcionarios</li>
                            <li>Eliminar funcionarios</li>
                          </ul>
                        </td>
                      </tr>
                      <tr>
                        <td>Seguimiento</td>
                        <td>
                         <p>Apartado conformado por los siguientes permisos:</p>
                         <ul>
                            <li>Visado Control Interno</li>
                            <li>Visado Contabilidad</li>
                          </ul>
                        </td>
                      </tr>
                    </tbody>
                  </table>
          </div><!-- card -->
        </div><!-- col-6 -->
@endsection