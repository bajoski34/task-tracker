<?php 

declare(strict_types=1);

namespace Abraham\Task\Contracts;

use Abraham\Task\Contracts\CommandInterface;

interface HandlerInterface {
    public function handle(CommandInterface $command, array $args = []): void;
}