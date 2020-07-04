<?php

namespace App\Http\Livewire\Stickers;

use App\Sticker as AppSticker;
use Carbon\Carbon;
use Livewire\Component;

class Sticker extends Component
{
    public $modelId;
    public $total;
    public $qrCode;
    public $qrStyle = 'square';
    public $qrColor = 'rgb(0,0,0)';
    public $registrationTitle = 'Radicado';
    public $incomingFooterTitle = 'Correspondencia recibida';
    public $outgoingFooterTitle = 'Correspondencia enviada';
    public $midTitle = 'Citar en caso de respuesta';
    public $dateFormat = 'day_month_year';

    const TEST_URL = 'https://inmail.com';

    public $styles = [
        'square', 'dot', 'round'
    ];

    public $qrStyles = [];
    public $dateFormats = [];

    public function mount($total, $modelId = null)
    {
        $this->total = $total;
        $this->modelId = $modelId;
        $this->generateQrCode();
        $this->generateQrStyles();
        $this->generateDateFormats();
    }

    public function generateQrCode()
    {
        $this->qrCode = \QrCode::size(100)->generate(self::TEST_URL);
    }

    public function generateQrStyles()
    {
        foreach ($this->styles as $style) {
            $this->qrStyles[$style] =  \QrCode::size(80)->style($style)
                ->generate(self::TEST_URL);
        }
    }

    public function generateDateFormats()
    {
        $this->dateFormats['day_month_year'] = Carbon::now()->format('d-m-Y H:i:s');
        $this->dateFormats['month_year_day'] = Carbon::now()->format('m-Y-d H:i:s');
        $this->dateFormats['year_month_day'] = Carbon::now()->format('Y-m-d H:i:s');
    }

    public function updated()
    {
        $this->qrCode = \QrCode::size(100)
            ->style($this->qrStyle)
            ->color(
                ...$this->passToInt($this->qrColor)
            )
            ->generate(self::TEST_URL);
    }

    public function passToInt(string $color): array
    {
        $cleaned =  substr($color, 4, strlen(substr($color, 4)) - 1);
        return explode(',', $cleaned);
    }

    public function submit()
    {
        $this->validate([
            'qrStyle' => 'required|min:3',
            'qrColor' => 'required|min:3',
            'dateFormat' => 'required',
            'registrationTitle' => 'required|min:3',
            'midTitle' => 'required|min:3',
            'incomingFooterTitle' => 'required|min:3',
            'outgoingFooterTitle' => 'required|min:3'
        ]);

        $this->store();
    }

    public function store()
    {
        //$this->checkLimitReached();

        AppSticker::create([
            'qr_style' => $this->qrStyle,
            'qr_color' => $this->qrColor,
            'date_format' => $this->dateFormat,
            'registration_title' => $this->registrationTitle,
            'mid_title' => $this->midTitle,
            'incoming_footer_title' => $this->incomingFooterTitle,
            'outgoing_footer_title' => $this->incomingFooterTitle,
            'company_id' => auth()->user()->company->id
        ]);

        return redirect()->route('companies.index');
    }

    public function checkLimitReached()
    {
        abort_if($this->total >= 3, 403);
    }

    public function render()
    {
        return view('livewire.stickers.sticker');
    }
}
