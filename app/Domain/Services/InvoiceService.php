<?php

namespace App\Domain\Services;

use App\Record;

class InvoiceService
{
    /**
     * Check if the invoice number of the record exists, record model method is invoked.
     *
     * @param integer|null $idRecord - Record id
     * @param string $invoiceNumber - Invoice number
     * @param integer $thirdParty - Third party id (provider)
     * @return App\Record | boolean
     */
    public static function invoiceExists($idRecord = null, $invoiceNumber, $thirdParty)
    {
        if ($invoiceNumber !== null && $thirdParty !== null) {
            return Record::invoiceNumberExists(
                $idRecord,
                $invoiceNumber,
                $thirdParty
            )->first();
        }

        return false;
    }
}
