<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class JobTitle extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $title,
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return "TITLE;CHARSET=UTF-8:$this->title";
    }
}
