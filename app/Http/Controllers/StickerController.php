<?php

namespace App\Http\Controllers;


class StickerController extends Controller
{
    public function create()
    {
        return view('stickers.create');
    }
}
