<?php

declare(strict_types=1);

namespace Abraham\Task\Commands;

use Abraham\Task\Contracts\CommandInterface;

abstract class BaseCommand implements CommandInterface {

    public function __construct(private array $args = []) {}

    abstract function execute(): int;
}