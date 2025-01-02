<?php 

declare(strict_types=1);

namespace Abraham\Task\Handlers;
use Abraham\Task\Contracts\HandlerInterface;
use Abraham\Task\Commands\DeleteCommand;
use Abraham\Task\Contracts\CommandInterface;
use Abraham\Task\Models\TaskManager;

final class DeleteCommandHandler implements HandlerInterface {

    private static array $OPTIONS = [
        "--id",
        "-i"
    ];

    public function __construct(private TaskManager $manager) {}

    public function handle(CommandInterface $command, array $args = []): void {
        if(!$command instanceof DeleteCommand) {
            throw new \Exception("Invalid Command");
        }
    
        $this->manager->remove($command->id);
    }
}