<?php 

declare(strict_types=1);

namespace Abraham\Task\Commands;

use Abraham\Task\Contracts\CommandInterface;


abstract class BaseCommand implements CommandInterface {
    abstract static function fromArray(array $inputArray = []): CommandInterface;
}