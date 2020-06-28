<?php

namespace App\Http\Controllers;
use QrCode;


class StickerController extends Controller
{
    public function index()
    {
        $code = QrCode::size(100)->generate('Qr de prueba');
        $codeTwo = QrCode::size(100)->phoneNumber('3144747983');
        return view('stickers.index', compact('code','codeTwo'));
    }
}
