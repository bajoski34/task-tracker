<?php

declare(strict_types=1);

namespace Abraham\Task\Commands;

use Abraham\Task\Contracts\CommandInterface;

final class AddCommand extends BaseCommand implements Commandinterface{
    public function execute() {
        echo "executing the add command";
    }

    
}