<?php

namespace Schruptor\Vcard\Commands;

use Illuminate\Console\Command;

class VcardCommand extends Command
{
    public $signature = 'vcard';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
