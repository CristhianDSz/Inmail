<?php

namespace App\Http\Livewire\Stickers;

use Carbon\Carbon;
use Livewire\Component;

class Sticker extends Component
{
    public $qrStyle = 'square';

    public $qrStyles = [];

    public $qrColor = 'rgb(0,0,0)';

    public $qrColors = [
        'black'  => 'rgb(0,0,0)',
        'red'    => 'rgb(255,0,0)',
        'gold'   => 'rgb(255,215,0)',
        'orange' => 'rgb(255,165,0)',
        'green'  => 'rgb(34,139,34)',
        'blue'   => 'rgb(0,191,255)',
        'purple' => 'rgb(147,112,219)',
        'pink'   => 'rgb(255,105,180)',
        'grey'   => 'rgb(192,192,192)',
        'brown'  => 'rgb(218,165,32)',
    ];


    public $registrationTitle = 'Radicado';
    public $footerTitle = 'Correspondencia';
    public $midTitle = 'Citar en caso de respuesta';

    public $qrCode = '';

    public $dateFormats = [];
    public $dateFormat = 'dayMonthYear';

    public $styles = [
        'square', 'dot', 'round'
    ];

    public function mount()
    {
        $this->qrCode = \QrCode::size(100)->generate('www.inmail.com');
        $this->generateQrStyles();
        $this->generateDateFormats();
    }

    public function updated()
    {
        $this->qrCode = \QrCode::size(100)
            ->style($this->qrStyle)
            ->color(
                $this->passToInt($this->qrColor)[0],
                $this->passToInt($this->qrColor)[1],
                $this->passToInt($this->qrColor)[2]
            )
            ->generate('www.inmail.com');
    }

    public function generateQrStyles()
    {
        foreach ($this->styles as $style) {
            $this->qrStyles[$style] =  \QrCode::size(100)->style($style)
                ->generate('www.inmail.com');
        }
    }

    public function generateDateFormats()
    {
        $this->dateFormats['dayMonthYear'] = Carbon::now()->format('d-m-Y H:i:s');
        $this->dateFormats['monthYearDay'] = Carbon::now()->format('m-Y-d H:i:s');
        $this->dateFormats['yearMonthDay'] = Carbon::now()->format('Y-m-d H:i:s');
    }

    public function passToInt(string $color)
    {
        $cleaned =  substr($color, 4, strlen(substr($color, 4)) - 1);
        return explode(',', $cleaned);
    }

    public function render()
    {
        return view('livewire.stickers.sticker');
    }
}
