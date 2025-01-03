<?php 

declare(strict_types=1);

namespace Abraham\Task\Commands;
use Abraham\Task\Contracts\CommandInterface;
use Abraham\Task\Models\Task;
use Abraham\Task\Models\Status;

class UpdateCommand extends BaseCommand implements CommandInterface {

    public static ?string $next = "ListCommand"; 

    public static array $chain = [
        "ListCommand" => [
            "filter" => "*"
        ]
    ];

    public function __construct(
        public ?int $id = null,
        public array $fields = []
        ) {

        if(\is_null($this->id)) {
            throw new \Exception("ID is required to delete a task. add --id or -i to your command" .PHP_EOL);
        }

        if(\is_nan($id) || $this->id <= 0) {
            throw new \Exception("Usage: update --id <POSITIVE INTEGER> --name 'Abraham do something' --status 'pending'". PHP_EOL);
        }

        if(empty($fields)) {
            throw new \Exception('Usage: update --id 1 --name "Abraham" --status "pending"');
        }

        if(array_key_exists('status', $this->fields)) {
            $this->fields['status'] = match ($this->fields['status']) {
                'pending' => Status::PENDING,
                'done' => Status::DONE,
                'in-progress' => Status::INPROGRESS,
                default => Status::PENDING
            };
        }

        $this->id--;
    }

    public static function fromArray(array $inputArray = []): UpdateCommand
    {
        if(!isset($inputArray['id']) && !isset($inputArray['i'])) {
            throw new \Exception("Usage: update --id <ID> --name 'Abraham do something' --status 'pending'" . PHP_EOL);
        }

        $id = isset($inputArray['id']) ? ((int)$inputArray['id'] ?: NAN) : ((int)$inputArray['i'] ?: NAN);

        self::renameKey('n', 'name', $inputArray);
        self::renameKey('s', 'status', $inputArray);

        $data = [];

        unset($inputArray["id"]);

        foreach (['name', 'status'] as $key) {
            if(isset($inputArray[$key]) && Task::canUpdate($key)) {
                $data[$key] = $inputArray[$key];
            }
        }

        return new self(
            $id,
            $data
        );
    }

    public static function renameKey(string $keyName, string $replacement, array &$data) {
        if(isset($data[$keyName])) {
            $data[$replacement] = $data[$keyName];
            unset($data[$keyName]);
        }
    }
}