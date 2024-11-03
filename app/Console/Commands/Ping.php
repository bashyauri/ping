<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Check;
use App\Jobs\SendPing;
use Illuminate\Console\Command;
use function Laravel\Prompts\{info};

use Illuminate\Contracts\Bus\Dispatcher;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: "ping", description: "Run through all checks and perform a ping check")]
class Ping extends Command
{
    public function handle(Dispatcher $bus): void
    {
        info(message: "Start pinging the universe... ");
        foreach (Check::query()->cursor() as $check) {

            $bus->dispatchNow(command: new SendPing(
                check: $check
            ));
        }
    }
}
