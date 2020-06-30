<div class="row">
   <div class="col-5">
        <p>Seleccione un modelo de QR</p>

        <div class="row">
            @foreach($qrStyles as $style => $qr)
                <label for="{{ $style }}" class="rdiobox rdiobox-success">
                    <input type="radio" value={{ $style }} id={{ $style }} wire:model="qrStyle">
                    <span>{!! $qr!!}</span>
                </label>
            @endforeach
            </div>

        <p>Seleccione un color de QR</p>

        <div class="row">
           @foreach($qrColors as $color => $value)
               <button 
                type="button" 
                class="btn btn-icon mr-1 mb-1 {{ $value === $qrColor ? 'active' : '' }}"
                id="{{ $color }}" 
                style="background-color: {{ $value }}"
                wire:model="qrColor"
                wire:click="$set('qrColor','{{ $value }}')">
                <div></div>
                </button>
           @endforeach
        </div>

        <p>Seleccione el nombre de título de Radicado</p>

        <div class="row">
            <input type="text" class="form-control" wire:model="registrationTitle">
        </div>

        <p>Seleccione el nombre del título medio</p>

        <div class="row">
            <input type="text" class="form-control" wire:model="midTitle">
        </div>

        <p>Seleccione el nombre del título inferior</p>

        <div class="row">
            <input type="text" class="form-control" wire:model="footerTitle">
        </div>

        <p>Seleccione el formato de fecha</p>

        <div class="row">
            <select class="form-control ht-50" wire:model="dateFormat">
               @foreach($dateFormats as $date => $value)
                    <option value="{{ $date }}">{{ $value }}</option>
               @endforeach
            </select>
        </div>
   </div>

   <div class="col-7">
        <div class="card w-75 mx-auto">
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
   </div>

</div>


