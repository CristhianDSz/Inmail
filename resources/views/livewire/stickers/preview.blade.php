<div>
    @if($stickers)
    @foreach ($stickers as $sticker)
            <div class="d-flex justify-content-between mb-1">
                <p class="mb-0 w-75">{{ $sticker->name }}</p>
                <a href="#" class="btn btn-teal btn-sm tx-12 text-white mr-2">
                    <i class="icon ion-edit"></i>
                </a>
                <button wire:click="deleteSticker({{ $sticker->id }})" class="btn btn-danger btn-sm tx-12 text-white mr-2" id="{{ $sticker->name }}">
                    <i class="icon ion-trash-a"></i>
                </button>
            </div>
        @endforeach
    @endif
</div>
