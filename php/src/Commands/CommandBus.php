<?php
declare(strict_types=1);

namespace Abraham\Task\Commands;

use Abraham\Task\Contracts\CommandInterface;
use Abraham\Task\Models\TaskManager;

final class CommandBus {
    /*@var array<string, object> */
    private static array $handlers = [];

    public function __construct(
        private TaskManager $manager
    ) {}

    private static function getCommandFQN(string $name) {
        return __NAMESPACE__."\\". $name;
    }

    public static function map(array $map = []) {
        static::$handlers = $map;
    }

    public function dispatch(CommandInterface $command, array $args = []) {
        $key = get_class($command);
        static::$handlers[$key]->handle($command, $args);

        if(!is_null($command::$next)) {
            $nextFQN = self::getCommandFQN($command::$next);
            $next = new $nextFQN();
            static::$handlers[$nextFQN]->handle($next, $args);
        }
    }
}