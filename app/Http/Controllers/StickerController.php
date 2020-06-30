<?php

namespace App\Http\Controllers;
use QrCode;


class StickerController extends Controller
{
    public function index()
    {
        return view('stickers.index');
    }
}
