<?php 

declare(strict_types=1);

namespace Abraham\Task\Commands;
use Abraham\Task\Models\Status;
use Abraham\Task\Models\Task;
use Abraham\Task\Contracts\CommandInterface;


class AddCommand extends BaseCommand implements CommandInterface {
    public static ?string $next = "ListCommand"; 

    public function __construct(public ?Task $task = null) {
        if(\is_null($this->task)) {
            throw new \Exception("Task cannot be empty");
        }
    }

    public static function fromArray(array $inputArray = []): AddCommand
    {

        if(!isset($inputArray['name']) && !isset($inputArray['n'])) {
            throw new \Exception("Missing option name. please add ---name or -n to the command. ". PHP_EOL);
        }

        if(!isset($inputArray['status'])) {
            $status = 0;
        } else {
            $status = match ($inputArray['status']) {
                'pending' => 0 ,
                'done' => 1 ,
                default => null
            };
        }

        $status = match ($status) {
            0 => Status::PENDING,
            1 => Status::DONE,
            default => Status::PENDING
        };

        return new self(
            new Task(
                $inputArray['name'] ?? $inputArray['n'],
                $status
            )
        );
    }
}