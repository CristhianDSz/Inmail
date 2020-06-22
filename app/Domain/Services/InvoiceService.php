<?php

namespace App\Domain\Services;

use App\Record;

class InvoiceService
{
    public static function invoiceExists($idRecord = null, $invoiceNumber, $thirdParty)
    {
        if ($invoiceNumber !== null && $thirdParty !== null) {
            return Record::invoiceNumberExists($idRecord, $invoiceNumber, $thirdParty)->first();
        }

        return false;
    }
}
