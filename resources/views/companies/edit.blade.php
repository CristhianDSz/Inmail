@extends('layouts.master')

@section('content')
 <div class="row row-sm">
  @can('update', App\Company::class)
    <div class="col-lg-12 mg-t-20 mg-lg-t-0">
      @include('partials.errors')
        <div class="card bd-0">
          <div class="card-header bg-white bd-0">
            <h6 class="tx-medium tx-14">Editar de empresa</h6>
          </div>
        <form action="{{route('companies.update',$company->id) }}" method="POST" enctype="multipart/form-data">
          
          @include('companies.form',[
            'submitButtonText' => 'Editar cambios'
          ])
          @method('PATCH')
          </form>
        </div><!-- card -->
    </div><!-- col-6 -->
  @endcan
 </div>
@section('scripts')
    <script>
      function readFile(event,elementOutput) {
       const output = document.getElementById(elementOutput)
       output.src =  URL.createObjectURL(event.target.files[0])
      }
      $("#logo").change(function (event) {
        readFile(event,"prelogo")
      })
      $("#print_logo").change(function (event) {
        readFile(event,"print_prelogo")
      })
    </script>
@endsection

@endsection