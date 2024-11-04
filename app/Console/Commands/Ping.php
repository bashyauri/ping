<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\SendPing;
use App\Models\Check;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;

use function Laravel\Prompts\info;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'ping', description: 'Run through all checks and perform a ping check')]
class Ping extends Command
{
    public function handle(Dispatcher $bus): void
    {
        info(message: 'Start pinging the universe... ');
        foreach (Check::query()->cursor() as $check) {

            $bus->dispatchNow(command: new SendPing(
                check: $check
            ));
        }
    }
}
