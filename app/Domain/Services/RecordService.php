<?php

namespace App\Domain\Services;

use App\Domain\Entities\RecordNumber;
use App\Record;

/**
 * Service class for the creation of the records.
 * Just call the records method passing the desired quantity with the other attributes
 * i.e RecordService::records(3, request()->all())
 */
class RecordService
{
    private static $instance;
    protected $collection;


    private function __construct()
    {
        $this->collection = [];
    }

    /**
     * Return the class instance - Singleton style
     *
     * @return App\Domain\Services\RecordService
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Register records inside the collection, it depends on the quantity
     *
     * @param integer $quantity
     * @param array $attributes
     * @return void
     */
    public function registerRecords($quantity, $attributes)
    {
        for ($i = 0; $i < $quantity; ++$i) {
            $attributes['number'] = $this->recordNumber($attributes['type']);
            $this->collection[] = Record::create($attributes);
        }
    }

    /**
     * Wrapper for the creation of the record number, the RecordNumber entity is invoked
     *
     * @param string $type - The record type (Entrada, Salida)
     * @return string
     */
    protected function recordNumber($type)
    {
        return RecordNumber::load($this->lastExistentRecord($type), $type)->generate();
    }

    /**
     * Retrieve the last record type inserted, necessary for the record number creation
     *
     * @param string $type - The record type  (Entrada, Salida)
     * @return App\Record
     */
    protected function lastExistentRecord($type)
    {
        return Record::getLast($type)->first();
    }

    /**
     * Check if record invoice number exists, the InvoiceService method is invoked
     *
     * @param integer | null $idRecord
     * @param array $attributes
     * @return App\Record | boolean
     */
    public static function recordHasInvoice($idRecord = null, $attributes)
    {
        return InvoiceService::invoiceExists(
            $idRecord,
            $attributes['invoice_number'],
            $attributes['third_party_id']
        );
    }

    /**
     * Retrieve all records from the collection, the registerRecords method is invoked.
     *
     * @param integer $quantity
     * @param array $attributes
     * @return array
     */
    public static function records($quantity, $attributes)
    {
        $instance = self::getInstance();
        $instance->registerRecords($quantity, $attributes);
        return $instance->collection;
    }
}
