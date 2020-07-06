<?php

namespace App\Http\Livewire\Stickers;

use App\Sticker;
use Livewire\Component;

class Preview extends Component
{

    public $stickers = [];

    public function mount($stickers)
    {
        $this->stickers = $stickers;
    }

    public function deleteSticker($id)
    {
        $sticker =  Sticker::find($id);
        $sticker->delete();
        return redirect()->route('companies.index');
    }

    public function render()
    {
        return view('livewire.stickers.preview');
    }
}
