<?php 

require __DIR__."/../vendor/autoload.php";

use Abraham\Task\Models\TaskManager;
use Abraham\Task\Models\Task;
use Abraham\Task\Commands\AddCommand;
use Abraham\Task\Commands\CommandBus;

try {
    $taskManager = TaskManager::getInstance();
    $CommandList = [ "add", "list", "delete", "update" ];
    $commandRegister = [];

    $commandName = $argv[1] ?? null;
    $options = array_slice($argv, 2) ?? [];

    $commandRegistry = new CommandBus($taskManager);
    $handlers = [];

    foreach($CommandList as $command) {
        $commandFQN = "Abraham\\Task\\Commands\\".ucfirst($command). 'Command';
        $handlerFQN = "Abraham\\Task\\Handlers\\".ucfirst($command). 'CommandHandler';
        $handlers[$commandFQN] = new $handlerFQN($taskManager);
    };

    $commandRegistry::map($handlers);

    if(is_null($commandName)) {
        throw new Exception("Usage: php $argv[0] <command>". PHP_EOL);
    }

    if(!in_array($commandName, $CommandList)) {
        throw new \Exception("Command not supported. option include (" . implode("|", $CommandList) . ")" . PHP_EOL );
    }

    $inputArray = [];

    $length  = count($options);

    if((($length % 2) !== 0)) {
        throw new \Exception("options passed should follow values: --name <value>". PHP_EOL);
    }

    for ($i = 0, $length  = count($options); $i < $length ; $i += 2) {
        $key = ltrim($options[$i], '-'); // Remove leading dashes
        $value = $options[$i + 1];
        $inputArray[$key] = $value;
    }

    $commandFQN = "Abraham\\Task\\Commands\\".ucfirst($commandName). 'Command';
    $commandInstance = $commandFQN::fromArray($inputArray);

    $commandRegistry->dispatch($commandInstance, $inputArray);

} catch (\Throwable $th) {
    echo $th->getMessage();
}


