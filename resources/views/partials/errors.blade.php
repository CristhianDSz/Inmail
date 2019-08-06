@if(count($errors))
<div class="alert alert-bordered alert-danger pd-5" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <ul>
    @foreach ($errors->all() as $error)
      <li class="tx-13">{{$error}}</li>
      @endforeach 
  </ul>
  </div>              
@endif
