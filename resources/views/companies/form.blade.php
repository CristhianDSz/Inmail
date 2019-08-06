@csrf
<div class="form-layout form-layout-1">
    <div class="row mg-b-25">
      <div class="col-lg-4">
        <div class="form-group">
          <label class="form-control-label tx-bold">Nombre o razón social: <span class="tx-danger">*</span></label>
        <input class="form-control form-control-sm tx-medium" type="text" name="name" placeholder="Ingrese el nombre de la compañía" value="{{old('name') ?? $company->name}}">
        </div>
      </div><!-- col-4 -->
      <div class="col-lg-4">
        <div class="form-group">
          <label class="form-control-label tx-bold">Nit/Cédula: <span class="tx-danger">*</span></label>
        <input class="form-control form-control-sm tx-medium" type="text" name="identification" placeholder="Identificación" value="{{old('identification') ?? $company->identification}}">
        </div>
      </div><!-- col-4 -->
      <div class="col-lg-4">
        <div class="form-group">
          <label class="form-control-label tx-bold">Correo de contacto: <span class="tx-danger">*</span></label>
        <input class="form-control form-control-sm tx-medium" type="email" name="email"  placeholder="empresa@correo.com" value="{{old('email') ?? $company->email}}">
        </div>
      </div><!-- col-4 -->
      <div class="col-lg-8">
        <div class="form-group mg-b-10-force">
          <label class="form-control-label tx-bold">Dirección: </label>
        <input class="form-control form-control-sm tx-medium" type="text" name="address" placeholder="Ingrese dirección" value="{{old('address') ?? $company->address}}">
        </div>
      </div><!-- col-8 -->
      <div class="col-lg-4">
        <div class="form-group mg-b-15-force">
          <label class="form-control-label tx-bold">Teléfono: </label>
        <input class="form-control form-control-sm tx-medium" type="text" name="phone" placeholder="Ingrese número de teléfono" value="{{old('phone') ?? $company->phone}}">
        </div>
      </div><!-- col-4 -->

      <div class="col-lg-3">
          <div class="form-group mg-t-15-force mg-b-15">
            <small>Una vez subida la imagen podrá previsualizarla (Max:5MB)</small>
              <label class="custom-file">
                  <input type="file" id="logo" name="logo" class="custom-file-input">
                  <span class="custom-file-control">Logo</span>
                </label>

              </div>
            <img id="prelogo" src="{{$company->logo ? asset('storage/'.$company->logo) : '#'}}" alt="Logo" width="150" />
      </div>
      <div class="col-lg-3">
          <div class="form-group mg-t-15-force mg-b-15">
            <small>Una vez subida la imagen podrá previsualizarla (Max:5MB)</small>
              <label class="custom-file">
                  <input type="file" id="print_logo" name="print_logo" class="custom-file-input">
                  <span class="custom-file-control">Logo Sticker</span>
                </label>

              </div>
              <img id="print_prelogo" src="{{$company->print_logo ? asset('storage/'.$company->print_logo) : '#'}}" alt="Logo" width="150" />
      </div>
    </div><!-- row -->

    <div class="form-layout-footer">
    <button type="submit" class="btn btn-teal">{{$submitButtonText ?? 'Guardar cambios'}}</button>
    <a href="{{route('companies.index')}}" class="btn btn-secondary">Regresar</a>
    </div><!-- form-layout-footer -->
</div>