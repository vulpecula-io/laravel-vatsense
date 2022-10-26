<?php

namespace Vulpecula\Vatsense\Commands;

use Illuminate\Console\Command;

class VatsenseCommand extends Command
{
    public $signature = 'laravel-vatsense';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
