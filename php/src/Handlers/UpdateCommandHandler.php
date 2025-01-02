<?php 

declare(strict_types=1);

namespace Abraham\Task\Handlers;
use Abraham\Task\Contracts\HandlerInterface;
use Abraham\Task\Commands\UpdateCommand;
use Abraham\Task\Contracts\CommandInterface;
use Abraham\Task\Models\TaskManager;

final class UpdateCommandHandler implements HandlerInterface {

    private static array $OPTIONS = [
        "--id",
        "-i",
        "--name",
        "-n",
        "--status",
        "-s"
    ];

    public function __construct(private TaskManager $manager) {}

    public function handle(CommandInterface $command, array $args = []): void {
        if(!$command instanceof UpdateCommand) {
            throw new \Exception("Invalid Command");
        }

        $fields = $command->fields;
        $id = $command->id;

        foreach ($fields as $field => $value) {
            $this->manager->update($id, $field, $value);
        }
    }
}