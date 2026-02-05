<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class Source extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $url
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return "SOURCE:$this->url";
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
