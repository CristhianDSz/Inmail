<div class="row d-flex justify-content-between">
   <div class="col-5 bg-white text-dark pb-3">
        <p>Seleccione un modelo de QR</p>

        <div class="row ml-1">
            @foreach($qrStyles as $style => $qr)
                <label for="{{ $style }}" class="rdiobox rdiobox-success">
                    <input type="radio" value={{ $style }} id={{ $style }} wire:model="qrStyle">
                    <span>{!! $qr!!}</span>
                </label>
            @endforeach
            </div>

        <p class="mb-1 mt-2">Seleccione un color de QR</p>

        <div class="row ml-1">
           @foreach($qrColors as $color => $value)
               <button 
                type="button" 
                class="btn btn-icon mr-1 mb-1 {{ $value === $qrColor ? 'active' : '' }}"
                id="{{ $color }}" 
                style="background-color: {{ $value }};width:30px;height:30px"
                wire:model="qrColor"
                wire:click="$set('qrColor','{{ $value }}')">
                <div></div>
                </button>
           @endforeach
        </div>

        <p class="mt-2 mb-1">Seleccione el nombre de título de Radicado</p>

        <div class="row">
            <input type="text" class="form-control form-control-sm w-75 ml-3" wire:model="registrationTitle">
        </div>
        @error('registrationTitle')
            <small class="parsley-errors-list filled d-block">{{ $message }}</small>
        @enderror

        <p class="mt-2 mb-1">Seleccione el nombre del título medio</p>

        <div class="row">
            <input type="text" class="form-control form-control-sm w-75 ml-3" wire:model="midTitle">
        </div>
        @error('midTitle')
            <small class="parsley-errors-list filled d-block">{{ $message }}</small>
        @enderror

        <p class="mt-2 mb-1">Seleccione el nombre del título inferior</p>

        <div class="row">
            <input type="text" class="form-control form-control-sm w-75 ml-3" wire:model="footerTitle">
        </div>

        @error('footerTitle')
            <small class="parsley-errors-list filled d-block">{{ $message }}</small>
        @enderror

        <p class="mt-2 mb-1">Seleccione el formato de fecha</p>

        <div class="row">
            <select class="form-control form-control-sm w-75 ml-3" wire:model="dateFormat">
               @foreach($dateFormats as $date => $value)
                    <option value="{{ $date }}">{{ $value }}</option>
               @endforeach
            </select>
        </div>
   </div>

   <div class="col-6">
        <div class="card mx-auto mb-3">
            <div class="card-body">
               <div class="row">
                    <div class="col-4">
                        {!! $qrCode !!}
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <img src="{{ $logo !== null ? asset('storage/'.$logo) : asset('img/logo.png') }}" alt="Logo" width="150">
                        </div>
                        <div class="row mt-2">
                            <p class="text-uppercase tx-18 mb-0">{{ $registrationTitle }} <span class="font-weight-bold tx-14">e020-###</span></p>
                        </div>
                        <div class="row">
                            <p class="text-uppercase tx-11 mb-1">({{ $midTitle }})</p>
                        </div>
                        <div class="row">
                            <p class="font-weight-bold">{{ $dateFormats[$dateFormat] }}</p>
                        </div>
                    </div>
               </div>
               <div class="row justify-content-center">
                    <div class="col-8">
                        <p class="text-uppercase text-center">{{ $footerTitle }} Recibido (a)</p>
                    </div>
               </div>
            </div>
        </div>
       {{-- <div class="card mt-3 mb-2">
           <div class="card-body mx-auto text-center">
                <p class="font-weight-bold"> Nombre (opcional):</p>
                <input class="form-control form-control-sm mb-2" type="text" wire:model="name">
            </div>
        </div> --}}
        <input type="button" class="btn btn-sm btn-teal w-75 d-block mx-auto font-weight-bold" value="Guardar" wire:click="submit()">
   </div>

</div>


