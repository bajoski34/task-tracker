<?php 

declare(strict_types=1);

namespace Abraham\Task\Handlers;
use Abraham\Task\Contracts\HandlerInterface;
use Abraham\Task\Commands\ListCommand;
use Abraham\Task\Contracts\CommandInterface;
use Abraham\Task\Models\TaskManager;
use Abraham\Task\Models\Status;

final class ListCommandHandler implements HandlerInterface {

    private static array $OPTIONS = [
        "--filter",
        "-f"
    ];

    public function __construct(private TaskManager $manager) {}

    public function handle(CommandInterface $command, array $args = []): void {
        if(!$command instanceof ListCommand) {
            throw new \Exception("Invalid Command");
        }

        $filter = $args['filter'] ?? $args['f'] ?? "*";

        // var_dump($args);

        $all = $this->manager->list();
        $pending = array_filter($all, fn($item) => $item->getStatus() === Status::PENDING );
        $done = array_filter($all, fn($item) => $item->getStatus() === Status::DONE );
    
        $list = match ($filter) {
            'pending' => $pending,
            'done'=> $done ,
            default => $all
        };

        $length = count($list);
        echo "List of Tasks ($filter)[$length]".PHP_EOL;

        foreach ($list as $position => $task) {
            $number = $position + 1;
            $taskName = $task->getName();
            $taskStatus =$task->getStatus()->value;
            echo "$number.  $taskName [$taskStatus]" . PHP_EOL;
        }
    }
}