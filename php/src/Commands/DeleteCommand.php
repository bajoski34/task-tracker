<?php 

declare(strict_types=1);

namespace Abraham\Task\Commands;
use Abraham\Task\Contracts\CommandInterface;

class DeleteCommand extends BaseCommand implements CommandInterface {

    public static ?string $next = "ListCommand"; 

    public function __construct(public ?int $id = null) {

        if(\is_null($this->id)) {
            throw new \Exception("ID is required to delete a task. add --id or -i to your command" .PHP_EOL);
        }

        if($this->id <= 0) {
            throw new \Exception("ID is required to be a postive integer" .PHP_EOL);
        }

        $this->id--;
    }

    public static function fromArray(array $inputArray = []): DeleteCommand
    {
        if(!isset($inputArray['id']) && !isset($inputArray['i'])) {
            throw new \Exception("Usage: delete --id <ID> or delete -i <ID>" . PHP_EOL);
        }

        $id = isset($inputArray['id']) ? ((int)$inputArray['id'] ?: NAN) : ((int)$inputArray['i'] ?: NAN);

        if(\is_nan($id)) {
            throw new \Exception("Pass a valid integer". PHP_EOL);
        }

        return new self(
            $id
        );
    }
}