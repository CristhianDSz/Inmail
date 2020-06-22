<?php

namespace App\Domain\Entities;

use Carbon\Carbon;

/**
 *  Class responsible for the creation of the record numbers
 *  Just Need to pass to load method the last record and the record type
 * 	After just call to the generate method and the record number will be returned.
 */
class RecordNumber
{
    protected $record;
    protected $year;
    protected $type;

    const START_SEQUENCE = '001';

    /**
     * Set the record, type and year properties
     *
     * @param App\Record | null $record
     * @param string $type
     * @return App\Domain\Entities\RecordNumber
     */
    public static function load($record = null, $type = 'Entrada')
    {
        $builder = new self();
        $builder->record = $record;
        $builder->year =  (string) Carbon::now()->year;
        $builder->type = $type;

        return $builder;
    }

    /**
     * Fill with zeros the sequence of the record number
     *
     * @param integer $sequence
     * @return string
     */
    public function fillWithZeros($sequence)
    {
        return str_pad($sequence, (3 - strlen($sequence)) + strlen($sequence), '0', STR_PAD_LEFT);
    }

    /**
     * Check if the incoming year is the current year
     * It compares the las three digits of both. 
     * i.e 019 !== 020
     * @param integer $year
     * @return boolean
     */
    public function isNotCurrentYear($year)
    {
        return substr(explode('-', $this->makeTag())[0], -3) != substr($year, -3);
    }

    /**
     * Create the record tag, composed by the first letter of the type and the year.
     *
     * @return string
     */
    protected function makeTag(): string
    {
        $recordYear = substr($this->year, -3);
        $tag = $this->type === 'Entrada' ? 'E' . $recordYear . '-' : 'S' . $recordYear . '-';

        return $tag;
    }

    /**
     * Make the record sequence, composed by the tag and the sequence number
     *
     * @return string
     */
    protected function makeSequence(): string
    {
        $digitsSequence = null;
        $sequence = 0;
        $recordYear = $this->year;

        if ($this->record) {
            $sequence = (int) explode('-', $this->record->number)[1];
            $recordYear = explode('-', $this->record->number)[0];
            $digitsSequence = (int) $sequence + 1;
        }

        if (!$this->record || $this->isNotCurrentYear($recordYear)) {
            $digitsSequence = self::START_SEQUENCE;
        }

        $digitsSequenceFilled = $this->fillWithZeros($digitsSequence);
        $digitsSequence = strlen($digitsSequence) < 3 ? $digitsSequenceFilled : $digitsSequence;

        return $this->makeTag() . "{$digitsSequence}";
    }

    /**
     * Generate the record number, the makeSequence method is invoked.
     *
     * @return string
     */
    public function generate(): string
    {
        return $this->makeSequence();
    }
}
