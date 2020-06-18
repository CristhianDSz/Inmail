<?php

namespace App\Domain\Entities;

use Carbon\Carbon;

/**
 *  Class responsible for the creation of the records sequence
 *  Just Need to pass to load method the last record and the record type
 * 	After just call to the generate method and the record number will be returned.
 */
class RecordBuilder
{
    protected $record;
    protected $year;
    protected $type;

    const START_SEQUENCE = '001';

    public static function load($record = null, $type = 'Entrada')
    {
        $builder = new self();
        $builder->record = $record;
        $builder->year =  (string) Carbon::now()->year;
        $builder->type = $type;

        return $builder;
    }

    public function fillWithZeros($sequence)
    {
        return str_pad($sequence, (3 - strlen($sequence)) + strlen($sequence), '0', STR_PAD_LEFT);
    }

    public function isNotCurrentYear($year)
    {
        return substr(explode('-', $this->makeRecordTag())[0], -3) != substr($year, -3);
    }

    protected function makeRecordTag(): string
    {
        $recordYear = substr($this->year, -3);
        $tag = $this->type === 'Entrada' ? 'E' . $recordYear . '-' : 'S' . $recordYear . '-';

        return $tag;
    }

    protected function makeRecordSequence(): string
    {
        $digitsSequence = null;
        $sequence = 0;
        $recordYear = $this->year;

        if ($this->record) {
            $sequence = (int) explode('-', $this->record->number)[1];
            $recordYear = explode('-', $this->record->number)[0];
        }

        if (!$this->record || $this->isNotCurrentYear($recordYear)) {
            $digitsSequence = self::START_SEQUENCE;
        } else {
            $digitsSequence = (int) $sequence + 1;
        }

        $digitsSequenceFilled = $this->fillWithZeros($digitsSequence);
        $digitsSequence = strlen($digitsSequence) < 3 ? $digitsSequenceFilled : $digitsSequence;

        return $this->makeRecordTag() . "{$digitsSequence}";
    }

    public function generate(): string
    {
        return $this->makeRecordSequence();
    }
}
