<?php 

declare(strict_types=1);

namespace Abraham\Task\Handlers;
use Abraham\Task\Contracts\HandlerInterface;
use Abraham\Task\Commands\AddCommand;
use Abraham\Task\Contracts\CommandInterface;
use Abraham\Task\Models\TaskManager;

final class AddCommandHandler implements HandlerInterface {

    private static array $OPTIONS = [
        "--name",
        "-n",
        "--status",
        "-s"
    ];

    public function __construct(private TaskManager $manager) {}

    public function handle(CommandInterface $command, array $args = []): void {
        if(!$command instanceof AddCommand) {
            throw new \Exception("Invalid Command");
        }
    
        $this->manager->add($command->task);
    }
}