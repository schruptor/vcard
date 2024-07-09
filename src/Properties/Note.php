<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class Note extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $note,
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return "NOTE;CHARSET=utf-8:$this->note";
    }
}
