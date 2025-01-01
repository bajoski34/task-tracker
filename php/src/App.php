<?php 

require __DIR__."/../vendor/autoload.php";

use Abraham\Task\Models\TaskManager;
use Abraham\Task\Models\Task;



try {
    $taskManager = TaskManager::getInstance();
    $commandRegister = [];
    # TODO: Register the several commands available.

    # TODO: Collect the arguments from the user.

    # TODO: execute the chain of command based on the the options provided.
    $CommandList = [ "list", "add", "delete", "update" ];

    /**
     * taskiee list
     * taskiee list --filter 'done'
     * taskiee add --name 'Do something' --status pending
     * taskiee delete --id 3
     * taskiee update --id 1 --name "Actual Do something"
     */
    $commandName = $argv[1];

    if(!in_array($commandName, $CommandList)) {
        throw new \Exception("Command not supported. option include (" . implode("|", $CommandList) . ")" . PHP_EOL );
    }
} catch (\Throwable $th) {
    echo $th->getMessage();
}


