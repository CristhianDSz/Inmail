<?php

namespace App\Http\Controllers;

use App\Sticker;

class StickerController extends Controller
{
    public function index()
    {
        return view('stickers.index');
    }

    public function create()
    {
        $total = (new Sticker())->total;

        return view('stickers.create', compact('total'));
    }

    public function edit(Sticker $sticker)
    {
        $total = (new Sticker())->total;

        return view('stickers.edit', compact('total', 'sticker'));
    }
}
