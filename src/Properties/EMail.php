<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class EMail extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $email,
        public string $type = 'INTERNET',
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        $seperator = $this->type === 'WORK' ? ';' : ':';

        return "EMAIL;type=$this->type$seperator$this->email";
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
