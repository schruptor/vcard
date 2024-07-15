<?php

namespace Schruptor\Vcard\Properties\Base;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class End extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public ?string $date = null,
        public ?string $time = null,
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        $date = $this->date ?: date('Y-m-d');
        $time = $this->time ?: date('H:i:s');

        return 'REV:'.$date.'T'.$time.'Z'.PHP_EOL.
            'END:VCARD';
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
